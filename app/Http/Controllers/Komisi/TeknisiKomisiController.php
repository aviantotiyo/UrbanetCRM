<?php

namespace App\Http\Controllers\Komisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataTeamSite;
use Illuminate\Support\Facades\DB;
use App\Exports\KomisiTeknisiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;


class TeknisiKomisiController extends Controller
{
    public function index(Request $request)
    {
        $query = DataTeamSite::with([
            'user:id,name,role',
            'user2:id,name,role',
            'user3:id,name,role',
            'ticketHC:id,ticket_code',
            'ticket:id,ticket_code',
            'client:id,nama,nopel'
        ])->whereNotNull('fee');

        // Filter: Nama teknisi
        if ($request->filled('user')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->user . '%'))
                    ->orWhereHas('user2', fn($q) => $q->where('name', 'like', '%' . $request->user . '%'))
                    ->orWhereHas('user3', fn($q) => $q->where('name', 'like', '%' . $request->user . '%'));
            });
        }

        // Filter: Tanggal dibuat (optional, jika `created_at` ada di DataTeamSite)
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $data = $query->latest()->paginate(20);

        // Olah teknisi unpaid di setiap baris
        $processed = collect();

        foreach ($data as $row) {
            $teknisiList = collect([
                ['user' => $row->user,  'fee' => $row->fee,     'paid' => $row->fee_paid,   'pos' => 1],
                ['user' => $row->user2, 'fee' => $row->fee_2,   'paid' => $row->fee_paid_2, 'pos' => 2],
                ['user' => $row->user3, 'fee' => $row->fee_3,   'paid' => $row->fee_paid_3, 'pos' => 3],
            ]);

            // Filter yang tidak kosong dan belum dibayar
            $unpaidList = $teknisiList->filter(fn($t) => $t['user'] && $t['paid'] != 1);

            // Gabungkan ke koleksi besar
            foreach ($unpaidList as $tech) {
                $processed->push([
                    'row_id' => $row->id,
                    'user' => $tech['user'],
                    'pos' => $tech['pos'],
                    'fee' => $tech['fee'],
                    'ticketHC' => $row->ticketHC,
                    'ticket' => $row->ticket,
                    'client' => $row->client,
                    'updated_at' => $row->updated_at,
                ]);
            }
        }

        return view('admin.komisi_teknisi.index', [
            'teknisiRows' => $processed,
            'pagination' => $data, // Tetap dikirim agar tombol pagination tetap bisa dipakai
        ]);
    }

    public function paidList()
    {
        $data = DataTeamSite::with([
            'user:id,name,role',
            'user2:id,name,role',
            'user3:id,name,role',
            'ticketHC:id,ticket_code',
            'ticket:id,ticket_code',
            'client:id,nama,nopel'
        ])
            ->where(function ($q) {
                $q->where('fee_paid', 1)
                    ->orWhere('fee_paid_2', 1)
                    ->orWhere('fee_paid_3', 1);
            })
            ->paginate(10);

        return view('admin.komisi_teknisi.paid', compact('data'));
    }

    public function markAsPaidMultiple(Request $request)
    {
        $selected = $request->input('selected_ids'); // format: array of "id|position"

        if (!$selected || !is_array($selected)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }

        DB::beginTransaction();
        try {
            foreach ($selected as $entry) {
                [$id, $pos] = explode('|', $entry);
                $team = DataTeamSite::find($id);

                if (!$team) continue;

                if ($pos === '1') {
                    $team->fee_paid = 1;
                    $team->fee_paid_at = now();
                } elseif ($pos === '2') {
                    $team->fee_paid_2 = 1;
                    $team->fee2_paid_at = now();
                } elseif ($pos === '3') {
                    $team->fee_paid_3 = 1;
                    $team->fee3_paid_at = now();
                }

                $team->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menandai fee sebagai dibayar.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel()
    {
        $query = DataTeamSite::with([
            'user:id,name,role',
            'user2:id,name,role',
            'user3:id,name,role',
            'ticketHC:id,ticket_code',
            'ticket:id,ticket_code',
            'client:id,nama,nopel'
        ])->whereNotNull('fee')->latest()->get();

        $teknisiRows = collect();

        foreach ($query as $row) {
            foreach (
                [
                    ['user' => $row->user, 'fee' => $row->fee, 'paid' => $row->fee_paid, 'pos' => 1],
                    ['user' => $row->user2, 'fee' => $row->fee_2, 'paid' => $row->fee_paid_2, 'pos' => 2],
                    ['user' => $row->user3, 'fee' => $row->fee_3, 'paid' => $row->fee_paid_3, 'pos' => 3],
                ] as $teknisi
            ) {
                if (!$teknisi['user'] || $teknisi['paid'] == 1) continue;

                $teknisiRows->push([
                    'row_id' => $row->id,
                    'pos' => $teknisi['pos'],
                    'user' => $teknisi['user'],
                    'fee' => $teknisi['fee'],
                    'ticketHC' => $row->ticketHC,
                    'ticket' => $row->ticket,
                    'client' => $row->client,
                    'updated_at' => $row->updated_at,
                ]);
            }
        }

        return Excel::download(new KomisiTeknisiExport($teknisiRows), 'komisi_teknisi.xlsx');
    }
}
