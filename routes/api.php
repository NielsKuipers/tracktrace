<?php

use App\Http\Controllers\LabelsController;
use App\Http\Controllers\PackagesController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('packages/log', [PackagesController::class, 'storeAPI'])->name('packages.log');
Route::middleware('auth:sanctum')->post('packages/labels', [LabelsController::class, 'store'])->name('packages.labels.print');
Route::middleware('auth:sanctum')->post('packages/{id}/updateStatus', [PackagesController::class, 'updateStatus'])->name('packages.status.update');
