<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'favorite_color',
        'favorite_animals',
        'message',
    ];

    protected $casts = [
        'favorite_animals' => 'array',
    ];
}
