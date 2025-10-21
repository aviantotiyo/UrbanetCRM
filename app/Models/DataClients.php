<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataClients extends Model
{

    use HasUuids, SoftDeletes;

    protected $table = 'data_clients';

    // PK UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nopel',
        'nama',
        'no_hp',
        'email',
        'nik',
        'alamat',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'loc_client',
        'paket',
        'tagihan',
        'user_pppoe',
        'pass_pppoe',
        'name_profile',
        'limit_radius',
        'odp_id',
        'odp_port_id',
        'tag',
        'active_user',
        'status',
        'note',
        'foto_depan',
        'lat',
        'long',
        'promo_day',
        'promo_day_start',
        'promo_day_end',
        'status_promo',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'active_user' => 'datetime',
    ];

    // Relasi ke ODP (meski tidak ada constraint FK di DB, ini tetap bisa)
    public function odp()
    {
        return $this->belongsTo(DataOdp::class, 'odp_id', 'id');
    }

    // Relasi ke ODP Port
    public function odpPort()
    {
        return $this->belongsTo(DataOdpPort::class, 'odp_port_id', 'id');
    }
    // (opsional) konstanta status untuk konsistensi pemakaian
    public const STATUS_ACTIVE   = 'active';
    public const STATUS_ISOLIR   = 'isolir';
    public const STATUS_SUSPEND  = 'suspend';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_BOOKING  = 'booking';
}
