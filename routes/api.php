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

/**
 * Fetches a collection of paginated results. 
 * Optional query string parameters
 * page - number
 * liimit - number
 */
Route::get('object/get-all-records', NVPReadAllController::class)->middleware('XssSanitizer');

/**
 * Fetches a record with the given key. 
 * Optional query string parameters: timestamp - unix timestamp
 */
Route::get('object/{key}', NVPReadOneController::class)->middleware('XssSanitizer');

/**
 * Creates a new rocord
 */
Route::post('object', NVPWriteController::class)->middleware('XssSanitizer', 'InputConverter');