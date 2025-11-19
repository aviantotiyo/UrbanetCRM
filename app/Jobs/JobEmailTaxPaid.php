<?php

namespace App\Jobs;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataSetting;
use Illuminate\Bus\Queueable;
use App\Models\DataBillingItem;
use App\Mail\TaxPaidInvoiceMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\WhatsApp\WhatsAppSender;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobEmailTaxPaid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billingId;

    /**
     * Create a new job instance.
     */
    public function __construct($billingId)
    {
        $this->billingId = $billingId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $billing = DataBilling::find($this->billingId);
        if (!$billing) return;

        // 🔹 Hitung pajak
        $setting = DataSetting::first();
        $taxPercent = $setting?->tax ?? 11;

        $tax = round($billing->amount_received * ($taxPercent / 100));
        $afterTax = $billing->amount_received - $tax;

        // 🔹 Update nilai pajak dan reset field manual transfer
        $billing->update([
            'tax'              => $tax,
            'after_tax'        => $afterTax,
            'fee_merchant'     => null,
            'kode_unik'        => null,
            'bank_name_manual' => null,
            'exp_tx_bank'      => null,
            'partner_id'       => null,
            'bank_check'       => null,
        ]);

        // 🔹 Ambil data client dan item billing
        $client = DataClients::find($billing->client_id);
        $items  = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)->get();

        if (!$client || !$client->email) return;

        // 🔹 Kirim email invoice
        Mail::to($client->email)->send(new TaxPaidInvoiceMail($billing, $client, $items));

        // 🔹 Kirim WhatsApp
        if ($client->no_hp) {
            $wa = new WhatsAppSender();
            $wa->sendPaymentSuccess($client, $billing->amount_received, $billing->merchant_ref);
        }

        // Log::info('[WA] Triggering sendPaymentSuccess');
        // try {
        //     $wa = new WhatsAppSender();
        //     $res = $wa->sendPaymentSuccess($client, $billing->amount_received, $billing->merchant_ref);
        //     Log::info('[WA RESULT]', $res);
        // } catch (\Throwable $e) {
        //     Log::error('[WA ERROR]', ['message' => $e->getMessage()]);
        // }
    }
}
