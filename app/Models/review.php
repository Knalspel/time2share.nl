<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = [
        'title',
        'text',
        'score',
        'reviewer_id',
        'account_id',
    ];

    public function reviews()
    {
        return $this->belongsTo(User::class, 'account_id');    
    }
}
