<?php

namespace App\Http\Controllers;

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
        //$path = request()->file('thumbnail')->store('thumbnails');
        $attributes = request()->validate([
         'title' => 'required',
         'thumbnail' => ' image',
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
       
        return view('admin.posts.edit', ['post' => $post]);
    }
    

     public function update(Post $post){
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => $post -> exists ? ['image'] :['required'|'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],//slug n pode ja existir
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
           ]);     

           if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
           }
           //se tem thumbnail, tem q guardar
           $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
           $post->update($attributes);
           return back()->with('success', 'Post Update');
     }

     public function destroy(Post $post){
        $post->delete();
        return back()->with('success', 'Post Deleted');
     }
}
