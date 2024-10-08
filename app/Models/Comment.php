<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id'); //comentario pertence a um post
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id'); //comentario pertence a um user
    }
}
