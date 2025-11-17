<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataClientsSales extends Model
{
    use SoftDeletes;

    protected $table = 'data_clients_sales';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'users_id',
        'paket_id',
        'nik',
        'nama',
        'no_hp',
        'email',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status',
        'client_prospect_id',
        'loc_client',
        'lat',
        'long',
        'foto_depan',
        'fee',
        'fee_paid',
        'fee_date_paid',
    ];

    protected $casts = [
        'fee_paid' => 'boolean',
        'fee_date_paid' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Otomatis generate UUID saat membuat record baru
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi ke User (sales)
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relasi ke DataPaket
    public function paket()
    {
        return $this->belongsTo(DataPaket::class, 'paket_id');
    }
}
