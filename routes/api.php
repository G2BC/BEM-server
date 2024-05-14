<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'fungi'], function () {
    Route::get('/taxonomy', 'FungiController@getByTaxonomy');
    Route::get('/stateAc/{stateAc}', 'FungiController@getByStateAc');
    Route::get('/bem/{id}', 'FungiController@getByBem');
    Route::get('/map', 'FungiController@groupedByStateAndClass');
});

