<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    protected $fillable = [

        'company_id',
        'title',
        'type',
        'start_date',
        'renewal_date',
        'cycle',
        'reminder_days',
        'vendor',
        'amount',
        'notes'

    ];
}
