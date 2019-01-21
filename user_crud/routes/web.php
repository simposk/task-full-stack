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

Route::get('dashboard', function () {
    return redirect('posts');
});

Route::get('/', function () {
    return redirect('posts');
});

Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');
Route::resource('posts', 'PostsController');
Route::post('/ajax-users', 'UsersController@upload');