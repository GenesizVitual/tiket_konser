<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TiketController;

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


Route::get('registrasi',[AuthController::class,'registrasi']);
Route::post('registrasi',[AuthController::class,'registrasi']);

Route::get('login',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'login']);

Route::get('dashboard',[TiketController::class,'daftar_booking']);

Route::resource('booking', PemesananController::class);

Route::post('filter', [TiketController::class, 'daftar_booking']);
Route::put('check-in/{id}', [TiketController::class, 'update_checkIn']);
Route::get('filter/{id}/edit', [TiketController::class, 'show']);

Route::put('tiket-update/{id}',[TiketController::class,'update']);
Route::delete('tiket-delete/{id}',[TiketController::class,'destroy']);



Route::get('laporan', [TiketController::class,'report']);