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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('general-one', [App\Http\Controllers\GeneralOneController::class, 'index'])->name('general.one');
Route::get('general-two', [App\Http\Controllers\GeneralTwoController::class, 'index'])->name('general.two');


Route::post('dateFilter', [App\Http\Controllers\GeneralOneController::class, 'dateFilter']);
