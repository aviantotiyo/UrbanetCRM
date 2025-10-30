<?php

namespace App\Http\Controllers\Ticket;

use App\Models\DataTicket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataBillingLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


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
        return view('ticket.compliance.tambah', compact('clients'));
    }

    // public function create()
    // {
    //     $clients = DataClients::select('id', 'nama', 'nopel', 'no_hp')
    //         ->latest()
    //         ->limit(5)
    //         ->get();

    //     return view('ticket.compliance.tambah', compact('clients'));
    // }


    public function clientSearch(Request $request)
    {
        $q = $request->get('q');

        $clients = DataClients::select('id', 'nama', 'nopel', 'no_hp')
            ->where(function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%")
                    ->orWhere('nopel', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->id,
                    'text' => "{$client->nopel} - {$client->nama} - {$client->no_hp}"
                ];
            });

        return response()->json($clients);
    }



    public function store(Request $request)
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

        $ticket = DataTicket::create([
            'id'              => Str::uuid(),
            'ticket_code'     => 'TC-' . strtoupper(Str::random(8)),
            'client_id'       => $request->client_id,
            'type_task'       => $request->type_task,
            'detail_task'     => $request->detail_task,
            'note'            => $request->note,
            'status'          => $request->status,
            'status_finish'   => $request->status_finish,
            'solving'         => $request->solving,
            'ticket_guarantee' => $request->ticket_guarantee ?? 0,
        ]);

        return redirect()->route('admin.dashboard.ticket.index')->with('success', 'Ticket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ticket = DataTicket::findOrFail($id);
        $clients = DataClients::select('id', 'nama', 'nopel')->get();

        return view('ticket.compliance.edit', compact('ticket', 'clients'));
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
