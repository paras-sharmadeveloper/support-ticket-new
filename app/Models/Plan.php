<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'users_limit',
        'tickets_limit'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
