<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreationRequestsController;
use App\Http\Controllers\PharmacyController;
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

Route::prefix('dashboard')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('pharmacies/create/{step?}', [PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('pharmacies/create/{step}', [PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::get('/', [PharmacyController::class, 'list'])->name('pharmacies.list');
});
