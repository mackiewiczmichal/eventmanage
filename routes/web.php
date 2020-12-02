<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\ImageUploadController;
use App\Models\Events;

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
Route::get('/', function(){
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/events', [EventsController::class, 'index']);
    Route::get('/events/joined', [EventsController::class, 'showJoined']);
    Route::get('/events/details/{event}', [EventsController::class, 'details']);
    Route::get('/events/new', [EventsController::class, 'create']);
    Route::post('/events/new', [EventsController::class, 'store']);
    Route::post('/events/new-message/{id}', [EventsController::class, 'storeEventMessage']);
    Route::get('/event/{event}', [EventsController::class, 'edit']);
    Route::post('/event/{event}', [EventsController::class, 'update']);
    Route::delete('/events/{event}', [EventsController::class, 'destroy']);
    Route::get('/event/participant/{event}', [ParticipantsController::class, 'addParticipant']);
    Route::delete('/event/participant/remove/{id}/{event}', [ParticipantsController::class, 'removeParticipant']);
    Route::post('/add-images/{id}', [ImageUploadController::class, 'storeImage']);

});

Route::get('/events/all', [EventsController::class, 'showAll']);



