<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTeamSite extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_team_site';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'users_id',
        'users_id_2',
        'users_id_3',
        'data_ticket_hc_id',
        'data_ticket_id',
        'client_id',
        'fee',
        'fee_2',
        'fee_3',
        'fee_paid',
        'fee_paid_2',
        'fee_paid_3',
        'fee_paid_at',
        'fee2_paid_at',
        'fee3_paid_at',
    ];

    /**
     * Relasi ke Users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'users_id_2');
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'users_id_3');
    }

    /**
     * Relasi ke DataTicketHc
     */
    public function ticketHc()
    {
        return $this->belongsTo(DataTicketHc::class, 'data_ticket_hc_id');
    }

    /**
     * Relasi ke DataTicket
     */
    public function ticket()
    {
        return $this->belongsTo(DataTicket::class, 'data_ticket_id');
    }

    /**
     * Relasi ke DataClients
     */
    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id');
    }
}
