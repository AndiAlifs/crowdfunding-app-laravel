<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\emailVerified;
use App\Http\Middleware\notAdmin;
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

Route::get('/route-1', function () {
    //
})->middleware(emailVerified::class);

Route::get('/route-2', function () {
    //
})->middleware(notAdmin::class);