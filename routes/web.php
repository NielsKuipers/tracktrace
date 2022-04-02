<?php

use App\Http\Controllers\LabelsController;
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
    Route::get('packages/log', [PackagesController::class, 'create'])->name('packages.log');
    Route::post('packages/log', [PackagesController::class, 'store'])->name('packages.log');
    Route::get('packages/log/csv', [PackagesController::class, 'createcsv'])->name('packages.log.csv');
});

Route::group(['middleware' => 'can:read/write'], function () {
    Route::get('packages/labels', [LabelsController::class, 'viewAll'])->name('packages.labels');
    Route::get('packages/labels/print', [LabelsController::class, 'create'])->name('packages.labels.print');
    Route::post('packages/labels', [LabelsController::class, 'store'])->name('packages.labels.print');
    Route::post('packages/labels', [LabelsController::class, 'labelToPDF'])->name('packages.labels.toPDF');
});

//TODO: add middleware this is just for puppeteer for now
Route::get('packages/label/{id}', [LabelsController::class, 'view'])->name('packages.view');
