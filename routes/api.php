<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login_api', 'AuthController@login');
    Route::post('logout_api', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');


    //по задаче не понятно, CRUD у  текущего юзера или просто по id. (не хватает подробности) => я реализовал просто по id, так как тз этого подразумевает наверное
    Route::get('/users/{user_id}/todos', 'Api\TodoController@index');
    Route::post('/users/{user_id}/todos', 'Api\TodoController@store');
    Route::get('/users/{user_id}/todos/{id}', 'Api\TodoController@show');
    Route::put('/users/{user_id}/todos/{id}', 'Api\TodoController@update');
    Route::delete('/users/{user_id}/todos/{id}', 'Api\TodoController@destroy');

    Route::group([
        'middleware' => 'jwt.verify',
//        'prefix' => '/users/1',
    ], function ($router) {

        Route::get('/user', 'UserController@getAuthenticatedUser');
    });

});
