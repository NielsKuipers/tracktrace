<?php

use App\Http\Controllers\PackagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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
})->name('home');

Route::get('register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->name('register')->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest')->name('login');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::group(['middleware' => 'can:company'], function () {

    Route::get('packages/log', [PackagesController::class, 'create'])->name('packages.log')->middleware('can:company');
    Route::post('packages/log', [PackagesController::class, 'store'])->name('packages.log')->middleware('can:company');
    Route::get('packages/log/csv', [PackagesController::class, 'createcsv'])->name('packages.log.csv')->middleware('can:company');
});
