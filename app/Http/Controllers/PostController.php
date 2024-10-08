<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //
    public function index(){

 
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search']))->paginate(3)->withQueryString()
            
        ]);
    }


    public function show(Post $post){
       //show a single post
        return view('posts.show', [
            'post' => $post
            
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
}
