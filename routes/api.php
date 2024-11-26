<?php

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
});

Route::group(['prefix' => 'fungi'], function () {
    Route::get('/', 'FungiController@getAll');
    Route::get('/taxonomy', 'FungiController@getByTaxonomy');
    Route::get('/heatmap', 'FungiController@heatMap');
    Route::get('/stateAc/{stateAc}', 'FungiController@getByStateAc');
    Route::get('/bem/{id}', 'FungiController@getByBem');
    Route::get('/mushroom/{uuid}', 'FungiController@getByUuid');
});

Route::group(['middleware' => ['auth:api', 'check.user.type:Admin,Specialist']], function () {

    Route::group(['prefix' => 'mushroom'], function () {
        Route::post('/create', 'FungiController@create');
        Route::get('/updateObservations', 'FungiController@updateObservations');
        Route::patch('/{uuid}/update', 'FungiController@update');
        Route::delete('/{uuid}/delete', 'FungiController@delete');
        Route::post('/{uuid}/occurrence/create', 'OccurrenceController@create');
    });

    Route::group(['prefix' => 'occurrence'], function () {
        Route::get('/', 'OccurrenceController@getAll');
        Route::get('/{uuid}', 'OccurrenceController@getByUuid');
        Route::patch('/{uuid}/update', 'OccurrenceController@update');
        Route::delete('/{uuid}/delete', 'OccurrenceController@delete');
    });
});

Route::group(['prefix' => 'infos'], function () {
    Route::get('/sub_menu', 'GeneralInfoController@getGeneralInfo');
});
