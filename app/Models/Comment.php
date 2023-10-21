<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public const REQUIRED_FIELD = [
        'id' => true,
        'body' => true,
        'post_id' => true,
    ];


    public $timestamps = false;
}
