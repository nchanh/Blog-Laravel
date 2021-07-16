<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/logout', [AuthController::class, 'signOut'])->name('signOut');
Route::group(['middleware' => 'locale'], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])
        ->name('change-language');

    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::get('/register', [AuthController::class, 'getRegister'])->name('register.get');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');

        Route::get('/password/reset', [AuthController::class, 'resetPassword'])->name('reset-password');
    });

    Route::group(['middleware' => 'checklogin'], function() {
        Route::get('/new-post', [PostController::class, 'create'])->name('post.create');
        Route::post('/new-post', [PostController::class, 'store'])->name('post.store');

        Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/update', [PostController::class, 'update'])->name('post.update');

        Route::get('/delete/{id}', [PostController::class, 'destroy']);

    });

    Route::get('/{slug}', [PostController::class, 'show'])->name('post.detail')
        ->where('slug', '[A-Za-z0-9-_]+');
});

