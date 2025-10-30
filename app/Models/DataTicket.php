<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_ticket';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'ticket_code',
        'client_id',
        'type_task',
        'detail_task',
        'note',
        'status',
        'status_finish',
        'solving',
        'ticket_guarantee',
    ];

    protected $casts = [
        'status_finish' => 'datetime',
        'ticket_guarantee' => 'boolean',
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
     * Relasi ke tabel data_clients
     */
    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id');
    }

    public function teamSite()
    {
        return $this->hasOne(DataTeamSite::class, 'data_ticket_id');
    }
}
