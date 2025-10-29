<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

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


    // === Scopes ===
    public function scopePaid($q)
    {
        return $q->where('status', 'PAID');
    }

    public function scopePending($q)
    {
        return $q->where('status', 'PENDING');
    }

    public function scopeExpired($q)
    {
        return $q->where('status', 'EXPIRED');
    }
}
