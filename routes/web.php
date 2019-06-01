<?php

use App\Http\Controllers\Blog\PostController;
// use Illuminate\Routing\Route;

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

 Route::get('/', 'WelcomeController@index')->name('welcome');
 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function(){
    Route::resource('categories', 'CategoryController');
    Route::get('posts/trash', 'PostController@trashIndex')->name('posts.trash.index');
    Route::put('posts/{post}/restore','PostController@restore')->name('posts.restore');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::put('users/{user}/make-admin','UserController@makeAdmin')->name('users.make.admin');
    Route::resource('users','UserController');
});



Route::get('/php',function(){
    echo phpinfo();
});

/* Category Route */
// Route::get('/categories','CategoryController@index');
// Route::get('/categories/new','CategoryController@create');
// Route::post('/categories','CategoryController@store');
// Route::get('/categories/{category}/edit','CategoryController@edit');
// Route::patch('/categories/{category}/update','CategoryController@update');
// Route::get('/categories/{category}/delete','CategoryController@delete');
