<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
