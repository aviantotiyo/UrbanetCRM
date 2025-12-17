<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataWarehouse extends Model
{
    use HasUuids;

    protected $connection = 'warehouse';
    protected $table = 'data_warehouses';

    protected $fillable = [
        'kode_gudang',
        'nama_gudang',
        'lokasi',
        'jenis',
    ];
}
