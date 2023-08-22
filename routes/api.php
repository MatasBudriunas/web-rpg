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

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/player', 'App\Http\Controllers\API\PlayerController@getPlayer');
    Route::get('/items', 'App\Http\Controllers\API\PlayerController@getPlayerItems');
    Route::get('/craft-item', 'App\Http\Controllers\API\CraftingController@craft');
    Route::post('/equip-item', 'App\Http\Controllers\API\PlayerController@equipItem');
    Route::post('/move', 'App\Http\Controllers\API\PlayerController@movePlayer');
    Route::get('/map', 'App\Http\Controllers\API\MapController@getMap');
});
