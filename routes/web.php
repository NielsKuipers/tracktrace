<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TrackingController;
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

Route::group(['middleware' => 'can:user'], function () {
    Route::get('tracked', [TrackingController::class, 'index'])->name('tracking.index');
    Route::get('tracked/package/{id}', [TrackingController::class, 'show'])->name('tracking.show');
    Route::get('tracked/create', [TrackingController::class, 'create'])->name('tracking.create');
    Route::post('tracked/store', [TrackingController::class, 'store'])->name('tracking.store');
    Route::post('tracked/review/{id}', [TrackingController::class, 'review'])->name('tracking.review');
});

Route::group(['middleware' => 'can:company'], function () {
    //package routes
    Route::get('packages/log', [PackagesController::class, 'create'])->name('packages.log');
    Route::post('packages/log', [PackagesController::class, 'store'])->name('packages.log');
    Route::get('packages/log/csv', [PackagesController::class, 'createCSV'])->name('packages.log.csv');
});

Route::group(['middleware' => 'can:read/write'], function () {
    //label routes
    Route::get('packages/labels', [LabelsController::class, 'viewAll'])->name('packages.labels');
    Route::get('packages/labels/print', [LabelsController::class, 'create'])->name('packages.labels.print');
    Route::post('packages/labels', [LabelsController::class, 'store'])->name('packages.labels.print');
    Route::post('packages/labels', [LabelsController::class, 'labelToPDF'])->name('packages.labels.toPDF');

    //package routes
    Route::get('packages/pickup', [PackagesController::class, 'createPickup'])->name('packages.pickup');
    Route::post('packages/pickup', [PackagesController::class, 'storePickup'])->name('packages.pickup.store');

    Route::get('business/customers', [BusinessController::class, 'index'])->name('business.index');
});

//TODO: add middleware this is just for puppeteer for now
Route::get('packages/label/{id}', [LabelsController::class, 'view'])->name('packages.view');
