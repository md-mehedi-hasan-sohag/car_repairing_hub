<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Select extends Model
{
    protected $fillable = [
        'user_id',
        'offered_service_id',
        'quantity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offeredService()
    {
        return $this->belongsTo(OfferedService::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
