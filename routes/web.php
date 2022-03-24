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

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// trip crud
Route::get('/trip/create', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
Route::get('/trip/delete/{id}', [App\Http\Controllers\TripController::class, 'destroy'])->name('delete-trip');
// Route::post('/create-trip', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
Route::post('/trip/store', [App\Http\Controllers\TripController::class, 'store']);

// itinerary 
Route::get('/trip/{id}/itinerary', [App\Http\Controllers\ItineraryController::class, 'index'])->name('itinerary');
Route::post('/itinerary/store', [App\Http\Controllers\ItineraryController::class, 'store']);

//event
Route::post('/trip/add-event', [App\Http\Controllers\EventController::class, 'store']);
Route::get('/trip/destroy-event/{id}', [App\Http\Controllers\EventController::class, 'destroy']);
Route::post('/trip/update-event/{id}', [App\Http\Controllers\EventController::class, 'update']);

// my account
Route::get('/account', [App\Http\Controllers\UserController::class, 'index'])->name('my-account');
Route::post('/account/store-email', [App\Http\Controllers\UserController::class, 'storeEmail'])->name('store-email');
Route::post('/account/store-password', [App\Http\Controllers\UserController::class, 'storePassword'])->name('store-password');

//collaboration
Route::get('/trip/{id}/collaborate', [App\Http\Controllers\CollaborateController::class, 'index'])->name('collaborate');
Route::get('/trip/{id}/collaborate/invite', [App\Http\Controllers\CollaborateController::class, 'invite'])->name('invite');
Route::post('/trip/{id}/collaborate/invite', [App\Http\Controllers\CollaborateController::class, 'StoreInvite'])->name('store-invite');
Route::get('/trip/{id}/collaborate/destroy', [App\Http\Controllers\CollaborateController::class, 'destroy'])->name('destroy-collaborator');

// Route::get('/account', function () {
//     return view('my_account');
// });
// Route::get('/my-details', )

Auth::routes();

// 
