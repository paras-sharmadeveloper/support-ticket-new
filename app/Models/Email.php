<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [

        'company_id',
        'user_id',
        'from_email',
        'to_email',
        'subject',
        'body',
        'type',
        'is_read'

    ];
    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class);
    }
}
