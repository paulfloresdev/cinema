<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cash_amount',
        'debit_amount',
        'credit_amount',
        'total_amount',
        'token',
        'redeemed',
        'register_id',

    ];
}
