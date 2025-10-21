<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataOdpLogs extends Model
{
    use HasUuids;

    protected $table = 'data_odp_logs';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'users_id',
        'odp_id',
        'odp_port',     // FK ke data_odp_port.id
        'client_id',
        'status',

    ];



    // ========================
    // Relationships
    // ========================

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }

    public function odp()
    {
        return $this->belongsTo(\App\Models\DataOdp::class, 'odp_id', 'id');
    }

    public function port()
    {
        // kolom FK bernama 'odp_port' (bukan *_id)
        return $this->belongsTo(\App\Models\DataOdpPort::class, 'odp_port', 'id');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id');
    }
}
