<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;


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

Route::get('/', [PagesController::class, 'index']);

Route::resource('/blog', PostsController::class);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::get('/account/settings', [App\Http\Controllers\AccountController::class, 'settings'])->name('account.settings')->middleware('auth');
Route::post('/account/upload', [AccountController::class, 'uploadProfilePicture'])->name('account.upload');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/account/{id}', [AccountController::class, 'show'])->name('account.show');

// Private account routes (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');
    Route::post('/account/upload', [AccountController::class, 'uploadProfilePicture'])->name('account.upload');
    Route::put('/account/update', [AccountController::class, 'updateProfile'])->name('account.update');
    Route::delete('/account/remove-picture', [AccountController::class, 'removeProfilePicture'])->name('account.remove-picture');
});

// Public profile view
Route::get('/users/{id}', [AccountController::class, 'show'])->name('users.show');


// About
Route::get('/about', function () {
    return view('about.index');
});


// Contact
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Comments
Route::post('/blog/{post}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comment.store');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');

// Likes
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');
