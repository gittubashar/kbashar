<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['path', 'visitor_hash', 'referrer', 'viewed_on'];

    protected function casts(): array
    {
        return ['viewed_on' => 'date'];
    }
}
