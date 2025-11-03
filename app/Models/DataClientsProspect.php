<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataClientsProspect extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_clients_prospect';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'client_id',
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'point',
        'status',
        'client_prospect_id',
    ];

    protected $casts = [
        'id' => 'string',
        'client_id' => 'string',
        'client_prospect_id' => 'string',
        'point' => 'integer',
        'status' => 'string',
    ];

    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id');
    }
}
