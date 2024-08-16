<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckIsAdmin;

Route::get('/', function () {
    return view('guestcalender');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
Route::get('/events/today', [EventController::class, 'getTodaysEvents']);
Route::get('today', [EventController::class, 'TodayNow']);
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/listguest', [EventController::class, 'listguest'])->name('events.listguest');
Route::get('/UserEvents', [EventController::class, 'indexUser'])->name('events.indexUser');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/current-events', [EventController::class, 'getCurrentEvents']);
Route::delete('/events/{id}', [EventController::class, 'deleteEvent']);

Route::middleware([CheckIsAdmin::class])->group(function () {
    Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
    Route::get('/events/today', [EventController::class, 'getTodaysEvents']);
    Route::get('/calendar', [FullCalenderController::class, 'index']);
    Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
    Route::resource('events', EventController::class)->except(['index', 'show']);
});
