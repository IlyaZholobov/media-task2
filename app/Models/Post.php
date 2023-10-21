<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    public const REQUIRED_FIELD = [
        'id',
        'title',
        'body',
    ];

    public $timestamps = false;


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->limit(3)->orderBy('id','desc');
    }

}
