<?php

use Illuminate\Http\Request;

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

Route::group([['prefixe' => '/api'], ['middleware' => 'api']], function(){
  Route::get('contacts', 'ContactController@index');
  Route::post('contact/store', 'ContactController@store');
  Route::patch('contact/{id}', 'ContactController@update');
  Route::get('contact/{id}', 'ContactController@show');
  Route::delete('contact/{id}', 'ContactController@delete');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
