<?php

// Apabila user selesai dalam masa promo dan tagihan awal mulai 
// dikirim, jo ini berisi pesen melalui WA agar user di ingatkan
// untuk membayar tagihan awal.

namespace App\Jobs;

use App\Models\DataBilling;
use App\Services\WhatsApp\WhatsAppSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPromoEndedNotification implements ShouldQueue
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
        $billingMonth = \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y');

        $message = "Halo {$client->nama},\n\nMasa promo Anda telah berakhir. Kami telah menerbitkan tagihan baru:\n\n"
            . "Inv: {$item->merchant_ref_id}\n"
            . "Periode: {$billingMonth}\n"
            . "Paket: {$item->name}\n"
            . "Total: Rp " . number_format($item->amount, 0, ',', '.') . "\n\n"
            . "Silakan lakukan pembayaran tepat waktu agar layanan tetap aktif.\n\n"
            . "Terima kasih 🙏";

        $wa->sendToClient($client, $message);
    }
}
