<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Auth;
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

// my account
Route::get('/account', [App\Http\Controllers\UserController::class, 'index'])->name('my-account');
Route::post('/account/store-email', [App\Http\Controllers\UserController::class, 'storeEmail'])->name('store-email');
Route::post('/account/store-password',[App\Http\Controllers\UserController::class, 'storePassword'])->name('store-password');

Route::group(['prefix' => 'trip'], function() {
    // trip crud
    Route::get('/create', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
    Route::get('/delete/{id}', [App\Http\Controllers\TripController::class, 'destroy'])->name('delete-trip');
    // Route::post('/create-trip', [App\Http\Controllers\TripController::class, 'create'])->name('create-trip');
    Route::post('/store', [App\Http\Controllers\TripController::class, 'store']);

    // itinerary 
    Route::get('/{id}/itinerary', [App\Http\Controllers\ItineraryController::class, 'index'])->name('itinerary');
    Route::post('/itinerary/store', [App\Http\Controllers\ItineraryController::class, 'store']);

    //event
    Route::post('/add-event', [App\Http\Controllers\EventController::class, 'store']);
    Route::get('/destroy-event/{id}', [App\Http\Controllers\EventController::class, 'destroy']);
    Route::post('/update-event/{id}', [App\Http\Controllers\EventController::class, 'update']);

    //collaboration
    Route::get('/{id}/collaborate', [App\Http\Controllers\CollaborateController::class, 'index'])->name('collaborate');
    Route::get('/{id}/invite', [App\Http\Controllers\CollaborateController::class, 'displayInvite'])->name('invite');
    Route::post('/{id}/invite', [App\Http\Controllers\CollaborateController::class, 'storeInvite'])->name('store-invite');
    Route::get('/{id}/destroy-invite/{invite_id}', [App\Http\Controllers\CollaborateController::class, 'destroyInvite'])->name('destroy-invite');
    Route::get('/{id}/destroy-collaborator/{collaborator_id}', [App\Http\Controllers\CollaborateController::class, 'destroyCollaborator'])->name('destroy-collaborator');
    Route::post('/{id}/add-task/{user_id}', [App\Http\Controllers\CollaborateController::class, 'storeTask']);

//trip tasks 
//Route::get('/trip/{id}/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');

// Route::get('/account', function () {
//     return view('my_account');
// });
// Route::get('/my-details', )
});

Auth::routes();

// 
