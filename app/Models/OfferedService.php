<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferedService extends Model
{
    protected $fillable = [
        'shop_id',
        'service_id',
        'cost',
        'notes',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function selects()
    {
        return $this->hasMany(Select::class);
    }
}
