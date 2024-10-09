<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

use App\Http\Controllers\AdminPostController;

use Illuminate\Support\Facades\Route;


 
//require_once('/path/to/MailchimpTransactional/vendor/autoload.php');

Route::get('/', [PostController::class, 'index'])->name('home');


Route::get('posts/{post:slug}',[PostController::class, 'show']);

Route::get('register',[RegisterController::class, 'create'])->middleware('guest'); //apenas user n autenticado acessem a rota
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');//destrói a sessao
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');


Route::post('posts/{post:slug}/comments',[PostCommentsController::class, 'store']);
 //adicionando um comentario especifico a um post especifico

 Route::post('newsletter', NewsletterController::class);


 //group 
 Route::middleware('can:admin')->group(function(){
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    //Route::patch('admin/posts/{post}edit', [AdminPostController::class, 'update']);
    /*Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::post('admin/posts', [AdminPostController::class, 'store']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'delete']);*/
 });


 Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
 Route::delete('admin/posts/{post}', [AdminPostController::class, 'delete'])->middleware('can:admin');

