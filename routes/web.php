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
    return view('get_started');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// trip crud
Route::get('/trip/create', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
Route::get('/trip/delete/{id}', [App\Http\Controllers\TripController::class, 'destroy'])->name('delete-trip');
// Route::post('/create-trip', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
Route::post('/trip/store', [App\Http\Controllers\TripController::class, 'store']);

// itinerary 
Route::get('/trip/{id}/itinerary', [App\Http\Controllers\ItineraryController::class, 'index'])->name('itinerary');
Route::post('/itinerary/store', [App\Http\Controllers\ItineraryController::class, 'store']);
Route::post('/itinerary/store', [App\Http\Controllers\ItineraryController::class, 'store']);
Route::get('/trip/{id}/itinerary/sections', [App\Http\Controllers\SectionController::class, 'create'])->name('sections');


Auth::routes();

// 
