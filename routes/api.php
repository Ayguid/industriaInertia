<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public
Route::get('/locations', [PublicApiController::class, 'locations']);
Route::get('/fetchCountries', [PublicApiController::class, 'fetchCountries']);
Route::get('/fetchStates', [PublicApiController::class, 'fetchStates']);
Route::get('/fetchCities', [PublicApiController::class, 'fetchCities']);
Route::get('/categories', [PublicApiController::class, 'categories']);
Route::get('/users', [PublicApiController::class, 'users']);
