<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'select_id',
        'amount',
        'transaction_type',
        'transaction_id',
        'payment_date',
    ];

    protected function casts(): array
    {
        return [
            'payment_date' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function select()
    {
        return $this->belongsTo(Select::class);
    }
}
