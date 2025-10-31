<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataTicketHc extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_ticket_hc';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'ticket_code',
        'client_id',
        'note',
        'status',
        'merk_kabel',
        'panjang_kabel',
        'sambungan_kabel',
        'status_finish',
    ];

    protected $casts = [
        'status_finish' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Relasi ke model DataClients
     */
    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'users_id');
    // }


    public function teamSite()
    {
        return $this->hasOne(DataTeamSite::class, 'data_ticket_hc_id');
    }
}
