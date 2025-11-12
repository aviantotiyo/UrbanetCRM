<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Carbon;

class DataBilling extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'data_billing';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'client_id',
        'new_member',
        'reference',
        'merchant_ref',
        'payment_method',
        'payment_name',
        'total_amount',
        'point',
        'fee_merchant',
        'fee_customer',
        'amount_received',
        'pay_code',
        'qr_url',
        'status',
        'expired_time',
        'instructions',
        'tax',
        'after_tax',
        'billing_create',
        'billing_paid',
        'kode_unik',
        'bank_name_manual',
        'exp_tx_bank',
        'partner_id',
        'bank_check',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'new_member'      => 'boolean',
        'fee_merchant'    => 'integer',
        'fee_customer'    => 'integer',
        'amount_received' => 'integer',
        'total_amount'    => 'integer',
        'expired_time'    => 'datetime',
        'billing_create'  => 'datetime',
        'billing_paid'    => 'datetime',
        'instructions' => 'array',
        'expired_time' => 'datetime',
    ];

    // === Relasi ke Client ===
    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id', 'id');
    }

    // === Relasi ke BillingItem (FK satu arah melalui merchant_ref → merchant_ref_id) ===
    public function billingItem()
    {
        return $this->hasOne(DataBillingItem::class, 'merchant_ref_id', 'merchant_ref');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\DataBillingItem::class, 'merchant_ref_id', 'merchant_ref');
    }

    public function partner()
    {
        return $this->belongsTo(DataPartner::class, 'partner_id');
    }


    // === Scopes ===
    public function scopePaid($q)
    {
        return $q->where('status', 'PAID');
    }

    public function scopeUnpaid($q)
    {
        return $q->where('status', 'UNPAID');
    }

    public function scopePending($q)
    {
        return $q->where('status', 'PENDING');
    }

    public function scopeExpired($q)
    {
        return $q->where('status', 'EXPIRED');
    }

    public function updateFromTripayResponse(array $tripay)
    {
        $this->reference       = $tripay['reference'] ?? null;
        $this->payment_method  = $tripay['payment_method'] ?? null;
        $this->payment_name    = $tripay['payment_name'] ?? null;
        $this->total_amount    = $tripay['amount'] ?? null;
        $this->fee_customer    = $tripay['total_fee'] ?? null;
        $this->amount_received = $tripay['amount_received'] ?? null;
        $this->pay_code        = $tripay['pay_code'] ?? null;
        $this->qr_url          = $tripay['qr_url'] ?? null; // akan null jika tidak ada
        $this->status          = $tripay['status'] ?? 'UNPAID';
        $this->expired_time    = Carbon::createFromTimestamp($tripay['expired_time']);
        $this->instructions    = $tripay['instructions']; // pastikan field ini bertipe `json` di DB

        return $this->save();
    }
}
