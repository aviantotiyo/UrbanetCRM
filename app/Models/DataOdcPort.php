<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataOdcPort extends Model
{
    use HasUuids;

    protected $table = 'data_odc_port';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'odc_id',
        'odp_id',     // mengacu ke data_odp.id sesuai permintaan
        'port_numb',
        'status',
    ];

    // (Opsional) Konstanta status untuk dipakai di controller / view
    public const STATUSES = ['available', 'reserved', 'active', 'faulty', 'blocked'];

    /* =========================
     |  Relationships
     |=========================*/

    // Relasi ke ODP (nama kolom tetap 'odp_id')
    public function odp()
    {
        return $this->belongsTo(\App\Models\DataOdp::class, 'odp_id', 'id');
    }

    public function odc()
    {
        return $this->belongsTo(\App\Models\DataOdc::class, 'odc_id', 'id');
    }


    // Jika nanti butuh relasi ke client seperti di ODP port, tinggal tambahkan:
    // public function client() { return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id'); }
}
