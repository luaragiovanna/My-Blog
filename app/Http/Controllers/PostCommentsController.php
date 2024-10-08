<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    //

    public function store(Post $post){ //finding a post
       //add um comentario p/ esse post
       //dd($post);
       //n precisa passar o post_idpq ja esta vinculado a ele campos (user_id, body)
       request()->validate([
        'body' => 'required'
       ]);

       $post->comments()->create([
        'body' =>request('body'),
        'user_id' => request()->user()->id
       ]);

       return back();
    }
}
