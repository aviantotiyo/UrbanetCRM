<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataCsr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_csr';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nopel',
        'nama',
        'detail_pic',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'loc_client',
        'lat',
        'long',
        'paket',
        'foto_depan',
        'user_pppoe',
        'pass_pppoe',
        'name_profile',
        'limit_radius',
        'odp_id',
        'odp_port_id',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi ke data_odp
    public function odp()
    {
        return $this->belongsTo(DataOdp::class, 'odp_id');
    }

    // Relasi ke data_odp_port
    public function odpPort()
    {
        return $this->belongsTo(DataOdpPort::class, 'odp_port_id');
    }
}
