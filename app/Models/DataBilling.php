<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataBilling extends Model
{
    use HasUuids;

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
        'amount',
        'fee_merchant',
        'fee_customer',
        'amount_received',
        'pay_code',
        'qr_url',
        'status',
        'expired_time',
        'sku',
        'name',
        'instructions',
        'billing_cycle',   // sudah dibetulkan
        'billing_create',
        'billing_paid',    // sekarang nullable
    ];

    protected $casts = [
        'new_member' => 'boolean',
        'amount'          => 'integer',
        'fee_merchant'    => 'integer',
        'fee_customer'    => 'integer',
        'amount_received' => 'integer',
        'expired_time'    => 'datetime',
        'billing_cycle'   => 'datetime',
        'billing_create'  => 'datetime',
        'billing_paid'    => 'datetime',
    ];

    // Relasi
    public function client()
    {
        return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id');
    }

    // (Opsional) helper scopes
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
