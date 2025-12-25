<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataItemMovements extends Model
{
    use HasUuids;

    protected $connection = 'warehouse';
    protected $table = 'data_item_movements';

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false; // hanya pakai created_at manual

    protected $fillable = [
        'item_id',
        'warehouse_from',
        'warehouse_to',
        'jumlah',
        'tipe',
        'ref_type',
        'created_by',
        'created_at',
    ];

    /* ======================
     | RELATIONS
     ====================== */

    public function item()
    {
        return $this->belongsTo(DataItems::class, 'item_id');
    }

    public function warehouseFrom()
    {
        return $this->belongsTo(DataWarehouse::class, 'warehouse_from');
    }

    public function warehouseTo()
    {
        return $this->belongsTo(DataWarehouse::class, 'warehouse_to');
    }

    /**
     * Soft relasi ke users (database utama)
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
