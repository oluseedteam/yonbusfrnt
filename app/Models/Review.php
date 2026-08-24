<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'location',
        'avatar',
        'rating',
        'service',
        'text',
        'source',
        'is_published',
    ];

    protected $casts = [
        'rating'       => 'integer',
        'is_published' => 'boolean',
    ];
}
