<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPaket extends Model
{
    use HasUuids, SoftDeletes;

    protected $table = 'data_paket';

    // PK UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'name_profile',
        'limit_radius',
    ];
}
