<?php

namespace App\Jobs\WAMessage;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\DataBilling;
use App\Services\WhatsApp\WhatsAppSender;
use Carbon\Carbon;

class PaidBillingAgent implements ShouldQueue
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
        if (!$billing || !$billing->client) return;

        $client = $billing->client;
        $item = $billing->items->first();

        $billingMonth = $item && $item->billing_cycle
            ? Carbon::parse($item->billing_cycle)->format('m/Y')
            : '-';

        $message = "*[E-Nota] Pembayaran* Halo {$client->nama},\n\n"
            . "Pembayaran Anda telah kami terima melalui mutasi bank. Terima kasih atas pembayarannya.\n\n"
            . "Detail Tagihan:\n"
            . "No.Inv: {$item->merchant_ref_id}\n"
            . "Periode: {$billingMonth}\n"
            . "Paket: {$item->name}\n"
            . "Jumlah: Rp " . number_format($billing->amount_received, 0, ',', '.') . "\n\n"
            . "Layanan Anda tetap aktif. 🙏";

        $wa->sendToClient($client, $message);

        // Opsional: log atau hitung notifikasi
        $billing->increment('message_count');
    }
}
