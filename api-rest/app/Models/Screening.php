<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'time',
        'regular_price',
        'child_price',
        'old_price',
        'discount',
        'movie_id',
        'room_id',
    ];
}
