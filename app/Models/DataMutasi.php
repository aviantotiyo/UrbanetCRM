<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataMutasi extends Model
{
    protected $table = 'data_mutasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'mutation_id',
        'account_number',
        'bank',
        'bank_name',
        'type',
        'description',
        'amount',
        'balance',
        'date',
        'mutasi_check',
        'mutasi_check_time',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
