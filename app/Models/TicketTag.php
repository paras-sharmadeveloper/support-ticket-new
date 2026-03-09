<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketTag extends Model
{
    protected $fillable = [
        'ticket_id',
        'department_id'
    ];
}
