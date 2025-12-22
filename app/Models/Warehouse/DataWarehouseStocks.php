<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataWarehouseStocks extends Model
{
    use HasUuids, SoftDeletes;

    protected $connection = 'warehouse';
    protected $table = 'data_warehouse_stocks';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'warehouse_id',
        'item_id',
        'category_id',
        'jumlah',
        'kode_rak',
    ];

    // Relasi opsional jika dibutuhkan
    public function warehouse()
    {
        return $this->belongsTo(DataWarehouse::class, 'warehouse_id');
    }

    public function item()
    {
        return $this->belongsTo(DataItems::class, 'item_id');
    }

    public function category()
    {
        return $this->belongsTo(DataCategories::class, 'category_id');
    }
}
