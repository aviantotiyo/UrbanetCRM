<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataOdc extends Model
{
    use HasUuids;

    protected $table = 'data_odc';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'server_id',
        'kode_odc',
        'nama_odc',
        'alamat',
        'prov',
        'kota',
        'kec',
        'desa',
        'loc_odp',
        'lat',
        'long',
        'port_cap',
        'port_install',
        'rasio',
        'warna_core',
        'core_cable',
        'note',
        'image',
    ];

    /* =========================
     |  Relationships
     |=========================*/
    public function server()
    {
        return $this->belongsTo(DataServer::class, 'server_id', 'id');
    }

    public function ports()
    {
        return $this->hasMany(\App\Models\DataOdcPort::class, 'odc_id', 'id');
    }
}
