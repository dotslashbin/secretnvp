<?php

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
use App\Http\Controllers\NVPReadAllController;
use App\Http\Controllers\NVPReadOneController;
use App\Http\Controllers\NVPWriteController;

Route::get('object/get-all-records', NVPReadAllController::class);
Route::get('object/{key}', NVPReadOneController::class);
Route::post('object', NVPWriteController::class);