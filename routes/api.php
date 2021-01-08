<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth_2',
    'namespace' => 'App\Http\Controllers\Auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Auth'
], function(){
    Route::post('register', 'RegisterController');
    Route::get('get_otp', 'OTPController');
    Route::post('update-password', 'UpdatePasswordController');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'campaign',
    'namespace' => 'App\Http\Controllers'
], function(){
    Route::get('random/{count}', 'CampaignController@random');
    Route::post('store', 'CampaignController@store');
    Route::get('/', 'CampaignController@index');
    Route::get('/{id}', 'CampaignController@detail');
    Route::get('search/{keyword}', 'CampaignController@search');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog',
    'namespace' => 'App\Http\Controllers'
], function(){
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});