<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'directors',
        'actors',
        'video_path',
        'img_path',
        'duration',
        'category',
        'gender',
    ];
    
}
