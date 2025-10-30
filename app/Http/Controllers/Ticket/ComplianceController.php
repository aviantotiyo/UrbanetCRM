<?php

namespace App\Http\Controllers\Ticket;

use App\Models\User;
use App\Models\DataTicket;
use App\Models\DataClients;
use App\Models\DataSetting;
use Illuminate\Support\Str;
use App\Models\DataTeamSite;
use Illuminate\Http\Request;
use App\Models\DataBillingLog;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\User;



class ComplianceController extends Controller
{
    public function index()
    {
        $tickets = DataTicket::all();
        return view('ticket.compliance.index', compact('tickets'));
    }

    public function create()
    {
        $clients = DataClients::select('id', 'nama', 'nopel', 'no_hp')->get();
        $installers = User::where('role', 'Installer')->select('id', 'name')->get();

        return view('ticket.compliance.tambah', compact('clients', 'installers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_id'         => 'required|uuid|exists:data_clients,id',
            'type_task'         => 'required|in:Gangguan,Customers Support,Support NOC,Maintenance',
            'detail_task'       => 'nullable|string',
            'note'              => 'nullable|string',
            'status'            => 'required|in:open,cancel,process,finish',
            'status_finish'     => 'nullable|date',
            'solving'           => 'nullable|string',
            'ticket_guarantee'  => 'nullable|boolean',
            'users_id'          => 'required|uuid|exists:users,id', // Tambahan validasi installer
        ]);

        // Simpan tiket utama
        $ticket = DataTicket::create([
            'id'                => Str::uuid(),
            'ticket_code'       => 'TC-' . strtoupper(Str::random(8)),
            'client_id'         => $request->client_id,
            'type_task'         => $request->type_task,
            'detail_task'       => $request->detail_task,
            'note'              => $request->note,
            'status'            => $request->status,
            'status_finish'     => $request->status_finish,
            'solving'           => $request->solving,
            'ticket_guarantee'  => $request->ticket_guarantee ?? 0,
        ]);

        // Simpan ke tabel DataTeamSite
        // $feeEngineer = DataSetting::first()?->fee_engineer ?? 0;
        DataTeamSite::create([
            'id'                => Str::uuid(),
            'users_id'          => $request->users_id,
            'data_ticket_id'    => $ticket->id,
            'client_id'         => $request->client_id,
            // 'fee'               => $feeEngineer,
        ]);

        return redirect()->route('admin.dashboard.ticket.index')->with('success', 'Ticket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ticket = DataTicket::findOrFail($id);
        $clients = DataClients::select('id', 'nama', 'nopel')->get();
        $installers = User::where('role', 'Installer')->get();
        $teamSite = DataTeamSite::where('data_ticket_id', $ticket->id)->first();

        return view('ticket.compliance.edit', compact('ticket', 'clients', 'installers', 'teamSite'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id'       => 'required|uuid|exists:data_clients,id',
            'type_task'       => 'required|in:Gangguan,Customers Support,Support NOC,Maintenance',
            'detail_task'     => 'nullable|string',
            'note'            => 'nullable|string',
            'status'          => 'required|in:open,cancel,process,finish',
            'status_finish'   => 'nullable|date',
            'solving'         => 'nullable|string',
            'ticket_guarantee' => 'nullable|boolean',
        ]);

        $ticket = DataTicket::findOrFail($id);

        $ticket->update([
            'client_id'       => $request->client_id,
            'type_task'       => $request->type_task,
            'detail_task'     => $request->detail_task,
            'note'            => $request->note,
            'status'          => $request->status,
            'status_finish'   => $request->status_finish,
            'solving'         => $request->solving,
            'ticket_guarantee' => $request->ticket_guarantee ?? 0,
        ]);


        return redirect()->route('admin.dashboard.ticket.index')
            ->with('success', 'Ticket berhasil diperbarui.');
    }
}
