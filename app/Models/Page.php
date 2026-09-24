<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug', 'eyebrow', 'excerpt', 'content', 'meta_title',
        'meta_description', 'is_system', 'is_published',
        'show_in_navigation', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_system' => 'boolean',
            'is_published' => 'boolean',
            'show_in_navigation' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
