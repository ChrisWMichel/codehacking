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

use App\Role;
use App\User;

Route::get('/', function () {
  $users = User::all();
  //$roles = Role::pluck('name', 'id')->all();

  /*echo '<pre>';
  print_r($roles);
  echo '</pre>';*/

    return view('admin.users.index', compact( 'users'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', function (){
  return view('admin.index');
});

Route::resource('admin/users', 'AdminUserController');