<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [

        'company_id',
        'department_id',
        'location',
        'asset_id',
        'asset_type',
        'ip',
        'serial_number',
        'model',
        'os',
        'ram',
        'manufacturing',
        'storage',
        'assigned_to',
        'email',
        'old_user'

    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
