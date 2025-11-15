<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataClientsPartner extends Model
{
    use SoftDeletes;

    protected $table = 'data_clients_partner';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'partner_id',
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
        'fee',
        'fee_paid',
        'fee_date_paid',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-generate UUID
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi ke Partner
    public function partner()
    {
        return $this->belongsTo(DataPartner::class, 'partner_id');
    }

    public function paket()
    {
        return $this->belongsTo(DataPaket::class, 'paket_id');
    }
}
