<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class DataPartner extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'data_partner';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_partner',
        'no_hp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'secret_token',
        'password',
        'status',
    ];


    public function billings()
    {
        return $this->hasMany(DataBilling::class, 'partner_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected $hidden = [
        'password',
        'secret_token',
    ];
}
