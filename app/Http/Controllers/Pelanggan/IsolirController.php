<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\DataClients;
use App\Models\DataClientLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsolirController extends Controller
{
    /**
     * Mengubah status pelanggan menjadi 'isolir' dan mencatat log.
     */
    public function __invoke(Request $request, string $id)
    {
        $client = DataClients::find($id);

        if (! $client) {
            return redirect()
                ->back()
                ->with('error', 'Data pelanggan tidak ditemukan.');
        }

        // Update status pelanggan
        $client->update([
            'status' => 'isolir',
        ]);

        $user = Auth::user();
        $actorId   = $user?->id;
        $actorName = $user?->name ?? 'Unknown User';
        $clientId  = $client->id;
        $clientName = $client->nama ?? $clientId;

        // Catat log aktivitas di data_client_logs
        DataClientLogs::create([
            'users_id'  => $actorId,
            'client_id' => $clientId,
            'status'    => sprintf(
                'User %s telah meng-isolir Client (%s)',
                $actorName,
                $clientName
            ),
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', "Pelanggan {$client->nama} telah diisolir.");
    }
}
