<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataItems extends Model
{
    use HasUuids, SoftDeletes;

    protected $connection = 'warehouse';
    protected $table = 'data_items';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'category_id',
        'unit_type',
        'spesifikasi',
        'barcode',
        'harga_satuan',
        'img',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(DataCategories::class, 'category_id');
    }
}
