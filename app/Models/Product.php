<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'deadline',
        'user_id',
    ];
    
    public function owner()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}


