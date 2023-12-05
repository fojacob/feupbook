<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

// Home
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');


Route::view('/about', 'pages.about')->name('about');
Route::view('/help', 'pages.help')->name('help');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/contacts', 'pages.contacts')->name('contacts');

// Posts
Route::controller(PostController::class)->group(function () {
    Route::get('/home/forYou', 'forYou')->name('forYou');
    Route::get('/home', 'list')->name('home');
    Route::get('/post/create', 'create')->name('post.create');
    Route::post('/post/create', 'store')->name('post.store');
    Route::get('/post/bookmarks', 'listBookmarks')->name('post.bookmarks');
    Route::get('/post/{id}', 'show')->name('post.show');
    Route::get('/post/{id}/edit', 'edit')->name('post.edit');
    Route::put('/post/{id}/edit', 'update')->name('post.update');   
    Route::delete('/post/{id}/delete', 'delete')->name('post.delete');
    Route::post('/post/{id}/like', 'like')->name('post.like');
    Route::delete('/post/{id}/dislike', 'dislike')->name('post.dislike');
    Route::post('/post/{id}/bookmark', 'bookmark')->name('post.bookmark');
    Route::delete('/post/{id}/unbookmark', 'unbookmark')->name('post.unbookmark');
});

// Comments
Route::controller(CommentController::class)->group(function () {
    Route::post('/comment/create', 'store')->name('comment.store');
    Route::delete('/comment/{id}/delete', 'delete')->name('comment.delete');
});


// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// User
Route::controller(UserController::class)->group(function () {
    Route::get('/user/{id}', 'show')->name('user.profile');
    Route::post('/user/{id}/follow', 'follow')->name('user.follow');
    Route::post('/user/{id}/unfollow', 'unfollow')->name('user.unfollow');
});

// Search
Route::controller(SearchController::class)->group(function () {
    Route::get('/search','show')->name('search.show');
    Route::get('/api/user', 'search')->name('search.api');
});

// Admin Management
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/user/{id}/edit', 'showUserManagement')->name('admin.manageUser');
    Route::post('/admin/user/{id}/edit', 'updateUser')->name('admin.updateUser');
});