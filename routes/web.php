<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aboutme', 'ContentController@index')->name('about-me');

//comments
Route::get('/{post}/comments', 'CommentController@index');
Route::post('/{post}/comments', 'CommentController@store');

//blog
Route::get('/blog', 'PostController@all')->name('blog');
Route::get('/blog/{post}', 'PostController@single');

//content
Route::get('/', 'ContentController@landing');
Route::get('/{content}', 'ContentController@single');


//admin
Route::get('/admin/{any}', 'AdminController@index')->where('any', '.*');
