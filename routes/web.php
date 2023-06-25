<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [App\Http\Controllers\GeneralOneController::class, 'index'])->name('general.one');
Route::get('check-api', [GeneralOneController::class, 'checkApi']);
// Route::get('/date-check', [App\Http\Controllers\GeneralOneController::class, 'dateCheck']);
Route::post('dateFilter', [App\Http\Controllers\GeneralOneController::class, 'dateFilter']);
