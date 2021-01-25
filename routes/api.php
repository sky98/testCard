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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('/login', 'LoginController@login');
Route::post('/recovery', 'LoginController@recovery');

Route::post('/user', 'UserController@store');
Route::post('/gameCard', 'GameCardsController@store');


Route::get('/gameCard/{name}', 'GameCardsController@show');


Route::get('/gameCard', 'GameCardsController@index');
Route::post('/collection', 'CollectionController@store');