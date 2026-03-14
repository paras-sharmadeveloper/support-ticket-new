<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessageAttachment extends Model
{
    protected $fillable = [

        'ticket_message_id',
        'file'

    ];

    public function message()
    {
        return $this->belongsTo(TicketMessage::class, 'ticket_message_id');
    }
}
