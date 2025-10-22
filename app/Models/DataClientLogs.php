<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataClientLogs extends Model
{
    use HasUuids;

    protected $table = 'data_client_logs';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'users_id',
        'client_id',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }

    /**
     * Relasi ke Client
     */
    public function client()
    {
        return $this->belongsTo(\App\Models\DataClients::class, 'client_id', 'id');
    }
}
