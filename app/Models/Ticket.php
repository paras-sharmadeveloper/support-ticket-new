<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [

        'ticket_number',
        'title',
        'description',
        'priority',
        'status',
        'department_id',
        'created_by',
        'assigned_to',
        'resolved_by',
        'resolved_at'

    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }
    public function tags()
    {
        return $this->hasMany(TicketTag::class);
    }
    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}
