<?php

namespace App\Http\Controllers\Ticket;

use App\Models\User;
use App\Models\DataClients;
use Illuminate\Support\Str;
use App\Models\DataTeamSite;
use App\Models\DataTicketHC;
use Illuminate\Http\Request;
use App\Models\DataTicketLog;
use App\Http\Controllers\Controller;

class HomeConController extends Controller
{
    /**
     * Tampilkan semua data tiket HC.
     */
    public function index()
    {
        $tickets = DataTicketHC::with('teamSite.user')->orderBy('created_at', 'desc')->paginate(20);
        return view('ticket.home_con.index', compact('tickets'));
    }

    /**
     * Tampilkan form tambah tiket HC untuk client tertentu.
     */
    public function create($id)
    {
        $client = DataClients::findOrFail($id);
        $installers = User::where('role', 'Installer')->select('id', 'name')->get();
        return view('ticket.home_con.tambah', compact('client', 'installers'));
    }

    /**
     * Simpan data tiket HC baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id'         => 'required|uuid|exists:data_clients,id',
            'status'            => 'required|in:open,process,pending,cancel,finish',
            'note'              => 'nullable|string',
            'merk_kabel'        => 'nullable|string',
            'panjang_kabel'     => 'nullable|string',
            'sambungan_kabel'   => 'nullable|string',
        ]);



        $ticket = DataTicketHC::create([
            'id'                => Str::uuid(),
            'ticket_code'       => 'PSB-' . strtoupper(Str::random(8)),
            'client_id'         => $request->client_id,
            'status'            => $request->status,
            'note'              => $request->note,
            'merk_kabel'        => $request->merk_kabel,
            'panjang_kabel'     => $request->panjang_kabel,
            'sambungan_kabel'   => $request->sambungan_kabel,
            'status_finish'     => now()

        ]);

        // 👷 Simpan ke DataTeamSite
        $teamSite = DataTeamSite::create([
            'id'                => Str::uuid(),
            'users_id'          => $request->users_id,
            'data_ticket_hc_id' => $ticket->id,
            'client_id'         => $request->client_id,
        ]);

        $installerName = User::find($request->users_id)->name ?? 'Unknown Installer';
        DataTicketLog::create([
            'id'                => Str::uuid(),
            'data_ticket_hc_id'    => $ticket->id,
            'status'            => sprintf(
                'Ticket PSB dengan kode %s untuk client %s telah ditujukan kepada %s pada %s',
                $ticket->ticket_code,
                $ticket->client->nama ?? 'Client Tidak Ditemukan',
                $installerName,
                now()->format('d-m-Y H:i:s')
            ),
        ]);

        return redirect()->route('admin.dashboard.ticket_hc.index')->with('success', 'Data tiket HC berhasil ditambahkan.');
    }
}
