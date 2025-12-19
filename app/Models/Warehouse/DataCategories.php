<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataCategories extends Model
{
    use HasUuids, SoftDeletes;

    protected $connection = 'warehouse';
    protected $table = 'data_categories';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
    ];
}
