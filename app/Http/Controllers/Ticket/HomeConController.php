<?php

namespace App\Http\Controllers\Ticket;

use App\Models\User;
use Aws\S3\S3Client;
use App\Models\DataImg;
use App\Models\DataClients;
use Illuminate\Support\Str;
use App\Models\DataTeamSite;
use App\Models\DataTicketHc;
use App\Models\DataSetting;
use Illuminate\Http\Request;
use App\Models\DataTicketLog;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeConController extends Controller
{
    /**
     * Tampilkan semua data tiket HC.
     */
    public function index()
    {
        $tickets = DataTicketHc::with('teamSite.user')->orderBy('created_at', 'desc')->paginate(20);
        return view('ticket.home_con.index', compact('tickets'));
    }

    /**
     * Tampilkan form tambah tiket HC untuk client tertentu.
     */
    // public function create($id)
    // {
    //     $client = DataClients::findOrFail($id);
    //     $installers = User::where('role', 'Installer')->select('id', 'name')->get();
    //     return view('ticket.home_con.tambah', compact('client', 'installers'));
    // }

    public function create($id)
    {
        $client = DataClients::findOrFail($id);
        $installers = User::where('role', 'Installer')->select('id', 'name')->get();

        // Hitung jumlah entri DataTicketHc berdasarkan client_id
        $jumlahInstalasi = DataTicketHc::where('client_id', $id)->count();

        // Jika sudah 2x atau lebih, set pesan peringatan
        $peringatan = null;
        if ($jumlahInstalasi >= 1) {
            $peringatan = '⚠️ Client ini sudah pernah dilakukan instalasi sebanyak ' . $jumlahInstalasi . ' kali.';
        }

        return view('ticket.home_con.tambah', compact('client', 'installers', 'peringatan'));
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

        $ticket = DataTicketHc::create([
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
            'users_id_2'          => $request->users_id_2,
            'users_id_3'          => $request->users_id_3,
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

    public function edit($id)
    {
        $ticket = DataTicketHc::with('teamSite.user', 'client', 'images')->findOrFail($id);
        $client = $ticket->client;
        $installers = User::where('role', 'Installer')->select('id', 'name')->get();


        return view('ticket.home_con.edit', compact('ticket', 'client', 'installers'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status'           => 'required|in:open,process,pending,cancel,finish',
            'note'             => 'nullable|string',
            'merk_kabel'       => 'nullable|string',
            'panjang_kabel'    => 'nullable|string',
            'sambungan_kabel'  => 'nullable|string',
            'users_id'         => 'required|uuid|exists:users,id',
            'users_id_2'       => 'nullable|uuid|exists:users,id',
            'images'           => 'nullable|array',
            'images.*'         => 'file|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ticket = DataTicketHc::findOrFail($id);

        // Update data utama tiket
        $ticket->update([
            'status'           => $request->status,
            'note'             => $request->note,
            'merk_kabel'       => $request->merk_kabel,
            'panjang_kabel'    => $request->panjang_kabel,
            'sambungan_kabel'  => $request->sambungan_kabel,
            'status_finish'    => now(),
        ]);


        // Update atau buat ulang data teknisi di DataTeamSite
        $teamSiteData = [
            'users_id'  => $request->users_id,
            'users_id_2' => $request->users_id_2,
            'client_id' => $ticket->client_id,
        ];

        if ($request->status === 'finish') {
            $feeEngineer = DataSetting::first()?->fee_engineer;
            $feeEngineer2 = DataSetting::first()?->fee_engineer_2;
            $teamSiteData['fee'] = (int) $feeEngineer;
            $teamSiteData['fee_2'] = $request->users_id_2 ? (int) $feeEngineer2 : null;
        }


        $ticket->teamSite()->updateOrCreate(
            ['data_ticket_hc_id' => $ticket->id],
            $teamSiteData
        );


        // Ambil nama teknisi dari DataTeamSite (relasi ke users)
        $teamSite = $ticket->teamSite;
        $technicianName = optional($teamSite->user)->name ?? 'Teknisi Tidak Diketahui';

        // Buat log aktivitas
        DataTicketLog::create([
            'id'                => Str::uuid(),
            'data_ticket_hc_id' => $ticket->id, // gunakan kolom khusus untuk tiket HC
            'status'            => sprintf(
                'Tiket %s diperbarui oleh %s dan ditangani oleh teknisi %s pada %s',
                $ticket->ticket_code,
                Auth::user()->name ?? 'User',
                $technicianName,
                now()->format('d-m-Y H:i:s')
            ),
        ]);



        // Proses upload gambar ke S3 jika ada
        if ($request->hasFile('images')) {
            $s3 = new S3Client([
                'version'     => 'latest',
                'region'      => env('AWS_DEFAULT_REGION', 'us-east-1'),
                'endpoint'    => env('AWS_ENDPOINT'),
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
                'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', true),
            ]);

            foreach ($request->file('images') as $file) {
                $filename = 'ticket_docs/doc_hc_' . Str::uuid() . '.' . $file->getClientOriginalExtension();

                try {
                    $result = $s3->putObject([
                        'Bucket' => env('AWS_BUCKET'),
                        'Key'    => $filename,
                        'Body'   => fopen($file->getRealPath(), 'r'),
                        'ACL'    => 'public-read',
                        'ContentType' => $file->getMimeType(),
                        'ContentDisposition' => 'inline',
                    ]);

                    $url = $result['ObjectURL'];

                    // Simpan ke database
                    DataImg::create([
                        'id'                => Str::uuid(),
                        'client_id'         => $ticket->client_id,
                        'data_ticket_hc_id' => $ticket->id,
                        'url_img'           => $url,
                        'tag'               => 'doc_hc',
                    ]);
                } catch (\Exception $e) {
                    Log::error('Gagal upload gambar: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('admin.dashboard.ticket_hc.index')
            ->with('success', 'Data berhasil diperbarui.');
    }
}
