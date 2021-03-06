<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::get('/admin', function(){

  return view('admin.index');

});

Route::group(['middleware' => 'admin'], function (){

  Route::resource('admin/users', 'AdminUserController');

  Route::resource('admin/comments', 'PostCommentsController');

  Route::resource('admin/comments/replies', 'CommentRepliesController');

});

Route::group(['middleware' => 'author'], function (){

  Route::resource('admin/posts', 'AdminPostsController');

  Route::resource('admin/categories', 'AdminCategoriesController');

  Route::resource('admin/media', 'PhotoController');

  Route::post('comment/replies', 'CommentRepliesController@createReply');

});