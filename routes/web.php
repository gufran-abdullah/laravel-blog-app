<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogApp;
use App\Http\Controllers\AdminApp;
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

// Blog Guest Side
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [BlogApp::class, 'index'])->name('index');

    Route::get('/login', [BlogApp::class, 'login_view'])->name('login');
    Route::post('/login', [BlogApp::class, 'login'])->name('login')->middleware('throttle:2,1');

    Route::get('/register', [BlogApp::class, 'register_view'])->name('register');
    Route::post('/register', [BlogApp::class, 'register'])->name('register')->middleware('throttle:2,1');

    Route::get('/blog_detail_guest/{id}', [BlogApp::class, 'blog_detail_view_guest'])->name('blog_detail_guest');
});


Route::group(['middleware' => 'auth'], function() {
    // Blog Client Side
    Route::get('/home', [BlogApp::class, 'home_view'])->name('home');
    Route::get('/blog_detail/{id}', [BlogApp::class, 'blog_detail_view'])->name('blog_detail');
    Route::get('/manage_profile/{id}', [BlogApp::class, 'manage_profile_view'])->name('manage_profile');
    Route::put('/manage_profile/{id}', [BlogApp::class, 'manage_profile'])->name('manage_profile');
    Route::get('/change_password/{id}', [BlogApp::class, 'change_password_view'])->name('change_password');
    Route::put('/change_password/{id}', [BlogApp::class, 'change_password'])->name('change_password');
    Route::get('/create_blog', [BlogApp::class, 'create_blog_view'])->name('create_blog');
    Route::post('/create_blog', [BlogApp::class, 'create_blog'])->name('create_blog');
    Route::get('/manage_blogs', [BlogApp::class, 'manage_blogs_view'])->name('manage_blogs');
    Route::get('/edit_blog/{id}', [BlogApp::class, 'edit_blog_view'])->name('edit_blog');
    Route::put('/update_blog/{id}', [BlogApp::class, 'update_blog'])->name('update_blog');
    Route::get('/delete_blog/{id}', [BlogApp::class, 'delete_blog'])->name('delete_blog');
    Route::get('/blog_detail_user/{id}', [BlogApp::class, 'blog_detail_user'])->name('blog_detail_user');
    Route::get('/logout', [BlogApp::class, 'logout'])->name('logout');
});


// Blog Admin Side
Route::group(['middleware', 'isAdmin'], function () {
  Route::get('/admin_home', [AdminApp::class, 'admin_home'])->name('admin_home');

  Route::get('/view_all_users', [AdminApp::class, 'view_all_users_view'])->name('view_all_users');
  Route::get('/user_detail_admin/{id}', [AdminApp::class, 'user_detail_admin'])->name('user_detail_admin');
  Route::get('/delete_user_admin/{id}', [AdminApp::class, 'delete_user_admin'])->name('delete_user_admin');

  Route::get('/create_user', [AdminApp::class, 'create_user_view'])->name('create_user');
  Route::post('/create_user', [AdminApp::class, 'create_user'])->name('create_user');

  Route::get('/view_all_blogs', [AdminApp::class, 'view_all_blogs_view'])->name('view_all_blogs');

  Route::get('/create_blog_admin', [AdminApp::class, 'create_blog_admin_view'])->name('create_blog_admin');
  Route::post('/create_blog_admin', [AdminApp::class, 'create_blog_admin'])->name('create_blog_admin');

  Route::get('/change_status/{id}', [AdminApp::class, 'change_status_view'])->name('change_status');
  Route::put('/change_status/{id}', [AdminApp::class, 'change_status'])->name('change_status');

  Route::get('/edit_blog_admin/{id}', [AdminApp::class, 'edit_blog_admin_view'])->name('edit_blog_admin');
  Route::put('/update_blog_admin/{id}', [AdminApp::class, 'update_blog_admin'])->name('update_blog_admin');

  Route::get('/delete_blog_admin/{id}', [AdminApp::class, 'delete_blog_admin'])->name('delete_blog_admin');
  
  Route::get('/blog_detail_admin/{id}', [AdminApp::class, 'blog_detail_admin'])->name('blog_detail_admin');

  Route::get('/admin_logout', [AdminApp::class, 'admin_logout'])->name('admin_logout');
});
