<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_published',
        'is_admin_only',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_admin_only' => 'boolean',
    ];
}