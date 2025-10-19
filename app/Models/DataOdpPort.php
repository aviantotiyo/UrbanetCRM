<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataOdpPort extends Model
{
    use HasUuids;

    protected $table = 'data_odp_port';

    // PK UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'odp_id',
        'client_id',
        'port_numb',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id');
    }

    public function odp()
    {
        return $this->belongsTo(DataOdp::class, 'odp_id', 'id');
    }

    // (opsional) konstanta status biar konsisten
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_RESERVED  = 'reserved';
    public const STATUS_ACTIVE    = 'active';
    public const STATUS_FAULTY    = 'faulty';
    public const STATUS_BLOCKED   = 'blocked';
}
