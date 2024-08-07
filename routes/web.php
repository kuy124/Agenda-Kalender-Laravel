<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

use App\Http\Controllers\FullCalenderController;



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

Route::get('/kontak', function () {
    return view('kontak');
});
Route::get('/', function () {
    return view('guestcalender');
});
Route::get('/login', function () {
    return view('login');
});
// Login route
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Logout route
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/events/today', [EventController::class, 'getTodaysEvents']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
Route::get('/events/listguest', [EventController::class, 'listguest'])->name('events.listguest');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{id}', [EventController::class, 'list'])->name('events.list');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::resource('events', EventController::class);
Route::get('/calendar', [FullCalenderController::class, 'index'])->middleware('auth');
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{event}', [EventController::class, 'update']);
Route::delete('/events/{event}', [EventController::class, 'destroy']);
