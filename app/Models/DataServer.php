<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataServer extends Model
{
    use HasUuids;

    protected $table = 'data_server';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_pop',
        'lokasi',
        'ip_public',
        'ip_static',
        'user',
        'password',
    ];
}
