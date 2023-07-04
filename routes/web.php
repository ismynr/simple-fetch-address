<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchAddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// API
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/search/provinces', [SearchAddressController::class, 'provinces']);
    Route::get('/search/cities', [SearchAddressController::class, 'cities']);
});
