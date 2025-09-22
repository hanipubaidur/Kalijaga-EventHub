<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Get the category that owns the event.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}