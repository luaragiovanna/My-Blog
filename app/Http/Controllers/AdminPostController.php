<?php

namespace App\Http\Models\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(10)
        ]);
    }
    public function create(){
        
        //show a form to create a post
         return view('admin.posts.create');
     }
 
     public function store(){
        //dd(request()->all());
 
        $path = request()->file('thumbnail')->store('thumbnails');
        $attributes = request()->validate([
         'title' => 'required',
         'thumbnail' => 'required | image',
         'slug' => ['required', Rule::unique('posts', 'slug')],//slug n pode ja existir
         'body' => 'required',
         'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);                                        //table //columm
        //atrelar o post criado ao usuario autenticado
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        Post::create($attributes);
        return redirect('/');
     }
     public function edit(Post $post){
        return view('admin.posts.edit');
     }
}
