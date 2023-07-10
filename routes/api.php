<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('registre', 'AuthController@registre');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::get('profile/{email}', 'myController@profile');
    Route::post('addCategory', 'myController@addCategory');
    Route::post('addPlat', 'myController@addPlat');
    Route::get('getCategorise', 'myController@getCategorise');
    Route::get('getPlats', 'myController@getPlats');
    Route::post('imageUpload', 'myController@imageUpload');
    Route::post('profileUpload', 'myController@profileUpload');
    Route::get('getEmployees', 'myController@getEmployees');

    Route::post('createCommande', 'myController@createCommande');
    Route::post('createLineOfCommande', 'myController@createLineOfCommande');
    Route::get('deletePlat/{id}', 'myController@deletePlat');
    Route::get('getCommands', 'myController@getCommands');
    Route::get('getLineCommands/{id}', 'myController@getLineCommands');
    Route::post('changeStatus', 'myController@changeStatus');
    Route::post('changeStatusCaissier', 'myController@changeStatusCaissier');

    Route::get('saveCommands', 'myController@saveCommands');
    Route::get('getLastDay', 'myController@getLastDay');
    Route::get('getNumOfCat', 'myController@getNumOfCat');
    Route::get('getNumOfPl', 'myController@getNumOfPl');
    Route::post('updateCategory', 'myController@updateCategory');
    Route::get('deleteCategory/{id}', 'myController@deleteCategory');
    Route::get('getCommandsLog', 'myController@getCommandsLog');
    Route::get('deleteEmp/{id}', 'myController@deleteEmp');

});