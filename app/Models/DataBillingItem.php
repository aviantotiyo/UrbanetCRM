<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataBillingItem extends Model
{
    use SoftDeletes;

    protected $table = 'data_billing_item';

    protected $fillable = [
        'id',
        'sku',
        'name',
        'amount',
        'billing_cycle',
        'discount',
        'merchant_ref_id',
    ];

    protected $casts = [
        'billing_cycle' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    // UUID auto-generate jika belum ada
    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // === Relasi balik ke billing utama ===
    public function billing()
    {
        return $this->belongsTo(DataBilling::class, 'merchant_ref_id', 'merchant_ref');
    }
}
