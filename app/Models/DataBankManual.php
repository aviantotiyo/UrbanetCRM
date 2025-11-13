<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataBankManual extends Model
{
    use SoftDeletes;

    protected $table = 'data_bank_manual';

    protected $fillable = [
        'id',
        'nama_bank',
        'nama_pic',
        'no_rek',
        'status',
    ];

    // Otomatis generate UUID saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
