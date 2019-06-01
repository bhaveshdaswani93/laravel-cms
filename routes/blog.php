<?php

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('posts/{post}','PostController@show')->name('blog.post');
Route::get('categories/{category}/posts','CategoryPostController')->name('blog.categories.post');
Route::get('tags/{tag}/posts','TagPostController')->name('blog.tags.post');