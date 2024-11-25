<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\RajaOngkirController;


Route::get('/beri', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class,'login']);
Route::apiResource('berita', BeritaController::class)->middleware('auth:sanctum');


//Route::resource('beri', BeritaController::class);

Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/rajaongkir/citys', [RajaOngkirController::class, 'getCities']);
Route::post('/rajaongkir/costs', [RajaOngkirController::class, 'getCost']);


