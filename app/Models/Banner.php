<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_link',
        'is_active',
        'position',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
