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

class JobSuspendUser implements ShouldQueue
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

        $message = "Halo {$client->nama},\n\nSaat anda telah masuk masa *tenggang pelanggan*:\n\n"
            . "No.Inv: {$item->merchant_ref_id}\n"
            . "Periode: {$billingMonth}\n"
            . "Paket: {$item->name}\n"
            . "Total: Rp " . number_format($item->amount, 0, ',', '.') . "\n\n"
            . "Jaringan akan aktif kembali setelah pelunasan.\n\n"
            . "Terima kasih 🙏";

        $wa->sendToClient($client, $message);

        // Update message_count
        $billing->update([
            'message_count' => 4
        ]);

        $client->update([
            'status' => 'suspend'
        ]);
    }
}
