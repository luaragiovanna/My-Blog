<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\MustBeAdministrator;
use App\Http\Models\Post\AdminPostController;
use App\Models\Category;
use GuzzleHttp\Middleware;
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


Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('auth');
//Route::get('/admin/posts/create',function(){} [PostController::class, 'admin']);
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('auth');
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('auth');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
