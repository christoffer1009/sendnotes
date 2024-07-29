<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'visibility',
        'user_id',
        'access_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
