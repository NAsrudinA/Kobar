<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dashboard/{tahun}', [ApiController::class, 'dashboard']);
Route::get('/list_ruas/{tahun}', [ApiController::class, 'list_ruas']);
Route::get('/list_sta/{id}', [ApiController::class, 'list_sta']);
Route::get('/peta_ruas/{id}', [ApiController::class, 'peta_ruas']);
Route::get('/getCenter/{id}', [ApiController::class, 'getCenter']);
Route::get('/detailSta/{id}', [ApiController::class, 'detailSta']);
Route::post('/store_detsta',[ApiController::class, 'store_detsta']);
Route::get('/detailFoto/{id}', [ApiController::class, 'detailFoto']);
Route::post('/simpanPickGambar', [ApiController::class, 'simpanPickGambar']);
Route::post('/simpanGambar', [ApiController::class, 'simpanGambar']);
Route::get('/semua_peta', [ApiController::class, 'semua_peta']);
Route::get('/saturuas/{id}', [ApiController::class, 'saturuas']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/store_sta', [ApiController::class, 'store_sta']);
Route::post('/store_rni',[ApiController::class, 'store_rni']);
