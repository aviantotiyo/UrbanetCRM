<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\DataBilling;
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

        // Update message_count
        $billing->update([
            'message_count' => 5
        ]);

        $client->update([
            'status' => 'inactive',
            'odp_id' => 'null',
            'odp_port_id' => 'null',
        ]);
    }
}
