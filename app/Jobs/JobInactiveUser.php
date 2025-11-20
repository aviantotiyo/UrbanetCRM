<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\DataBilling;
use App\Models\DataOdpLogs;
use App\Models\DataOdpPort;
use App\Models\DataOdp;
use App\Services\WhatsApp\WhatsAppSender;
use Carbon\Carbon;

class JobInactiveUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billingId;

    public function __construct($billingId)
    {
        $this->billingId = $billingId;
    }

    public function handle(WhatsAppSender $wa)
    {
        $billing = DataBilling::with(['client', 'items'])->find($this->billingId);
        if (!$billing) return;

        $client = $billing->client;
        $item = $billing->items->first();
        $billingMonth = Carbon::parse($item->billing_cycle)->format('m/Y');

        $message = "Halo {$client->nama},\n\nSaat ini kami telah melakukan *pemutusan jaringan*. Anda perlu melakukan permintaan penyambungan kembali melalui CS dan lakukan pembayaran agar jaringan kembali aktif.\n\nBerikut ini adalah tagihan internet Anda:\n\n"
            . "No.Inv: {$item->merchant_ref_id}\n"
            . "Periode: {$billingMonth}\n"
            . "Paket: {$item->name}\n"
            . "Total: Rp " . number_format($item->amount, 0, ',', '.') . "\n\n"
            . "Pelanggan akan aktif kembali setelah pelunasan tunggakan serta melakukan *registrasi ulang* melalui CS.\n\n"
            . "Terima kasih 🙏";

        $wa->sendToClient($client, $message);

        // Update billing message_count
        $billing->update([
            'message_count' => 4
        ]);

        // Simpan data lama sebelum null-kan
        $oldPortId  = $client->odp_port_id;
        $oldOdpId   = $client->odp_id;
        $clientName = $client->nama ?? 'UNKNOWN';
        $clientNopel = $client->nopel ?? 'UNKNOWN';

        // Update client status dan lepas port
        $client->update([
            'status' => 'inactive',
            'odp_id' => null,
            'odp_port_id' => null,
        ]);

        // Update port jika ada
        if ($oldPortId) {
            $port = DataOdpPort::find($oldPortId);
            if ($port) {
                $port->client_id = null;
                $port->status = 'available';
                $port->save();
            }
        }

        // Ambil kode untuk log (fallback ke ID jika tidak ada)
        $odpKode   = DataOdp::where('id', $oldOdpId)->value('kode_odp') ?? $oldOdpId;
        $portKode  = DataOdpPort::where('id', $oldPortId)->value('port_numb') ?? $oldPortId;

        $odpExists  = DataOdp::where('id', $oldOdpId)->exists();
        $portExists = DataOdpPort::where('id', $oldPortId)->exists();

        // Simpan log
        DataOdpLogs::create([
            'users_id'  => null, // karena dijalankan oleh sistem
            'odp_id'    => $odpExists ? $oldOdpId : null,
            'odp_port'  => $portExists ? $oldPortId : null,
            'client_id' => $client->id,
            'status'    => sprintf(
                '[SYSTEM] Client (%s)-(%s) dinonaktifkan otomatis dan ODP(%s)/Port(%s) dilepas karena tidak membayar hingga akhir bulan.',
                $clientName,
                $clientNopel,
                $odpKode,
                $portKode
            ),
        ]);
    }
}
