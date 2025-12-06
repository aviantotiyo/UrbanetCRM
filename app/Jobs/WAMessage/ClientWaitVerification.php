<?php

namespace App\Jobs\WAMessage;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\DataBilling;
use App\Services\WhatsApp\WhatsAppSender;

class ClientWaitVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billingId;

    public function __construct($billingId)
    {
        $this->billingId = $billingId;
    }

    public function handle(WhatsAppSender $wa)
    {
        $billing = DataBilling::with(['client', 'items', 'partner'])->find($this->billingId);
        if (!$billing || !$billing->client) return;

        $client = $billing->client;
        $item = $billing->items->first();
        $partnerName = $billing->partner->nama_partner ?? 'Mitra Tidak Dikenal';

        $message = "*[Konfirmasi Pembayaran]* \n\n"
            . "Halo {$client->nama}, Kami telah menerima konfirmasi pembayaran dari mitra/agen untuk tagihan Anda.\n\n"
            . "Saat ini sistem *sedang memverifikasi transaksi* (estimasi 15–20 menit).\n\n"
            . "Detail Tagihan:\n"
            . "No.Inv: {$item->merchant_ref_id}\n"
            . "Paket: {$item->name}\n"
            . "Mitra: {$partnerName}\n"
            . "Jumlah: Rp " . number_format($billing->amount_received, 0, ',', '.') . "\n\n"
            . "Mohon tunggu, *E-Nota akan dikirim otomatis* setelah pembayaran tervalidasi.\n\n"
            . "Terima kasih 🙏";

        $wa->sendToClient($client, $message);

        // Optional: log atau update message_count
        // $billing->increment('message_count');
    }
}
