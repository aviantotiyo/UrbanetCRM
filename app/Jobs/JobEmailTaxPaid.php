<?php

namespace App\Jobs;

use App\Mail\TaxPaidInvoiceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\DataBilling;
use App\Models\DataBillingItem;
use App\Models\DataClients;
use App\Models\DataSetting;

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

        // Hitung pajak
        $setting = DataSetting::first();
        $taxPercent = $setting?->tax ?? 11;

        // Hitung nilai pajak & pendapatan setelah pajak
        $tax = round($billing->amount_received * ($taxPercent / 100));
        $afterTax = $billing->amount_received - $tax;

        // Simpan nilai ke database
        $billing->tax = $tax;
        $billing->after_tax = $afterTax;
        $billing->save();

        // Ambil data client dan billing item
        $client = DataClients::find($billing->client_id);
        $items  = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)->get();

        if (!$client || !$client->email) return;

        // Kirim email invoice
        Mail::to($client->email)->send(new TaxPaidInvoiceMail($billing, $client, $items));
    }
}
