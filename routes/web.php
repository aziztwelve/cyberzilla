<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'HomeController@getCurrentUser')->name('user');
Route::post('/user', 'HomeController@updateCurrentUser')->name('user_update');



Route::get('/todo', 'HomeController@updateCurrentUser')->name('user_update');
Route::post('/todo', 'HomeController@updateCurrentUser')->name('user_update');

Route::get('/todo', 'TodoController@index')->name('todo.index');
//Route::get('/todo/create', 'TodoController@create')->name('todo.create');
//Route::post('/todo', 'TodoController@store')->name('todo.store');
Route::get('/todo/edit/{id}', 'TodoController@edit')->name('todo.edit');
Route::put('/todo/edit/{id}', 'TodoController@update')->name('todo.update');
Route::delete('/todo/delete/{id}', 'TodoController@destroy')->name('todo.destroy');

Route::get('/todo/{id}', 'TodoController@getTodo');


