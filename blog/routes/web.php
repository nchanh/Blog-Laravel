<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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
Route::get('/logout', [LoginController::class, 'signOut'])->name('signOut');
Route::group(['middleware' => 'locale'], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])
        ->name('change-language');

    Route::prefix('auth')->group(function () {
        // Login
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
        // Register
        Route::get('/register', [RegisterController::class, 'index'])->name('register.get');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

        Route::group(['middleware' => 'guest'], function() {
            // Forgot password
            Route::get('/password/reset', [ForgotPasswordController::class, 'index'])->name('reset-password');
            Route::post('/password/reset', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
            // Reset password
            Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
            Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
        });

    });

    Route::group(['middleware' => 'checklogin'], function() {
        // Posts
        Route::resource( 'posts', PostController::class)
            ->only('store', 'create', 'update', 'edit');
        Route::get('/posts/{id}/delete', [PostController::class, 'destroy']);
    });

    Route::resource( 'posts', PostController::class)
        ->only('show');
});
