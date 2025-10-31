<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataImg extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_img';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'client_id',
        'data_ticket_hc_id',
        'data_ticket_id',
        'url_img',
        'tag',
    ];

    // Relasi
    public function client()
    {
        return $this->belongsTo(DataClients::class, 'client_id');
    }

    public function ticketHC()
    {
        return $this->belongsTo(DataTicketHC::class, 'data_ticket_hc_id');
    }

    public function ticket()
    {
        return $this->belongsTo(DataTicket::class, 'data_ticket_id');
    }
}
