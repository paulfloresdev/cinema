<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'is_open',
        'open_at',
        'closed_at',
        'open_cash_amount',
        'cash_amount',
        'total_cash_amount',
        'debit_amount',
        'credit_amount',
        'total_amount',
        'user_id',

    ];
}
