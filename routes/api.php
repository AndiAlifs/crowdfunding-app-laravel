<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Auth'
], function(){
    Route::post('register', 'RegisterController');
    Route::get('get_otp', 'OTPController');
    // Route::get('login', 'LoginController');
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
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog',
    'namespace' => 'App\Http\Controllers'
], function(){
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});