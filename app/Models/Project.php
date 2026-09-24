<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'summary', 'description', 'technologies',
        'project_url', 'github_url', 'cover_image', 'is_featured',
        'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
