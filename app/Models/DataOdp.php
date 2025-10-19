<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataOdp extends Model
{
    use HasUuids;

    protected $table = 'data_odp';

    // PK UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_odp',
        'server_id',
        'nama_odp',
        'alamat',
        'prov',
        'kota',
        'kec',
        'desa',
        'loc_odp',
        'port_cap',
        'port_install',
        'vlan',
        'warna_core',
        'core_cable',
        'note',
    ];

    public function ports()
    {
        return $this->hasMany(\App\Models\DataOdpPort::class, 'odp_id', 'id');
    }

    public function server()
    {
        return $this->belongsTo(\App\Models\DataServer::class, 'server_id', 'id');
    }
}
