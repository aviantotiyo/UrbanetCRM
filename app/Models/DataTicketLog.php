<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DataTicketLog extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'data_ticket_log';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'data_ticket_hc_id',
        'data_ticket_id',
        'status',
    ];

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
}
