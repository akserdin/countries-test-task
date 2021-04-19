<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [CountryController::class, 'app']);
Route::get('country', [CountryController::class, 'index']);
Route::get('country-file', [CountryController::class, 'export']);
Route::post('country-file', [CountryController::class, 'storeFile']);
Route::post('country', [CountryController::class, 'store']);
Route::put('country/{country}', [CountryController::class, 'update']);
Route::delete('country/{country}', [CountryController::class, 'destroy']);
