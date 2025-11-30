<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'shop_name',
        'location',
        'opening_hours',
        'closing_hours',
        'description',
        'average_rating',
        'total_reviews',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offeredServices()
    {
        return $this->hasMany(OfferedService::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'offered_services')
                    ->withPivot('cost', 'notes')
                    ->withTimestamps();
    }
}
