<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Support\Carbon;

class TaxPaidInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $billing;
    public $client;
    public $items;

    public function __construct(DataBilling $billing, DataClients $client, $items)
    {
        $this->billing = $billing;
        $this->client = $client;
        $this->items = $items;
    }

    public function build()
    {
        return $this->subject('Invoice Pembayaran #' . $this->billing->merchant_ref)
            ->view('emails.billing.paid-invoice');
    }
}
