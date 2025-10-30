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
        'data_ticket_hc_id',
        'data_ticket_id',
        'client_id',
        'fee',
    ];

    /**
     * Relasi ke Users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
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
