<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\DummyDataController;

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


Route::post('/insert-data', [DummyDataController::class, 'insertData']);
Route::get('/fetch-data', [DummyDataController::class, 'fetchData']);
Route::get('/fetch-data-all', [DummyDataController::class, 'fetchDataAll']);
Route::post('/pay-midtrans',[MidtransController::class,'create'])->name('midtrans.create');
Route::post('/webhook-midtrans',[MidtransController::class,'webhook'])->name('midtrans.webhook');
