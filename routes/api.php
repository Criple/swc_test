<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResourceController;
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

Route::prefix('resources')->name('resources.')->group(function() {
    Route::get('/', [ResourceController::class, 'index'])->name('index');
    Route::post('/', [ResourceController::class, 'store'])->name('store');
    Route::get('/{resource}/bookings', [ResourceController::class, 'getBookings'])->name('getBookings');
});

Route::prefix('bookings')->name('bookings.')->group(function() {
   Route::post('/', [BookingController::class, 'store'])->name('store');
   Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
});
