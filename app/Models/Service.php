<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'description',
        'category',
    ];

    public function offeredServices()
    {
        return $this->hasMany(OfferedService::class);
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'offered_services')
                    ->withPivot('cost', 'notes')
                    ->withTimestamps();
    }
}
