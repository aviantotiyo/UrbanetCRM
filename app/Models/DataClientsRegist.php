<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataClientsRegist extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'data_clients_regist';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nik',
        'paket_id',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status',
    ];

    /**
     * Relasi ke DataPaket
     * Setiap registrasi terkait dengan satu paket internet
     */
    public function paket()
    {
        return $this->belongsTo(DataPaket::class, 'paket_id');
    }
}
