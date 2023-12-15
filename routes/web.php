<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::get('/createpost', [PostsController::class, 'createPost'])->middleware('authentificated');
Route::post('/createpost', [PostsController::class, 'store']);


Route::resource('/post', 'App\Http\Controllers\PostsController' );
Route::resource('/auth', 'App\Http\Controllers\AuthController' );
Route::resource('/tags',  'App\Http\Controllers\TagController');


//Route::get('/createpost', [PostsController::class, 'createPost'] )->middleware('authentificated');


Route::middleware('notauthentificated')->group(function () {
    Route::get('/login',[AuthController::class, 'showLogin'] );
    Route::get('/register', [AuthController::class,'showRegister']);

});

Route::middleware('authentificated')->group(function () {
    Route::get('/createpost',[PostsController::class, 'createPost'] );
    Route::get('/logout', [AuthController::class,'destroy']);

});

//Route::get('/login', [AuthController::class, 'showLogin'])->middleware('notauthentificated');
//Route::get('/register', [AuthController::class, 'showRegister'])->middleware('notauthentificated');
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);
//Route::post('/logout', [AuthController::class, 'logout'])->middleware('authentificated');


//Route::post('/createcomment', [CommentsController::class, 'store']);
//Route::post('/deletecomment/{id}', [CommentsController::class, 'destroy']);
