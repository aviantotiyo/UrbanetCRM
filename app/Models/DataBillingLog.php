<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataBillingLog extends Model
{
    use HasUuids;

    protected $table = 'data_billing_log';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'client_id',
        'merchant_ref_id',
        'status',
    ];

    // === Relasi ===
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id');
    }

    public function billing()
    {
        return $this->belongsTo(\App\Models\DataBilling::class, 'merchant_ref_id', 'merchant_ref');
    }
}
