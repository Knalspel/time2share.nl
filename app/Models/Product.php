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
        'category',
        'image',
        'user_id',
        'loaner_id',
        'status',
    ];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function loaner()
    {
        return $this->belongsTo(User::class, 'loaner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}


