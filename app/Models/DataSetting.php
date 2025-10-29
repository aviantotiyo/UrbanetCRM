<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataSetting extends Model
{
    use HasUuids;

    protected $table = 'data_setting';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'denda',
        'point',
        'tax',
        'fee_merchant_billing',
        'fee_merchant_sales',
        'fee_sales_internal',
        'fee_engineer_sales',
        'fee_engineer',
    ];
}
