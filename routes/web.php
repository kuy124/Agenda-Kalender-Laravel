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
Route::get('/events/today', [EventController::class, 'getTodaysEvents']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{id}', [EventController::class, 'list'])->name('events.list');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::resource('events', EventController::class);
Route::get('/', [FullCalenderController::class, 'index']);
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{event}', [EventController::class, 'update']);
Route::delete('/events/{event}', [EventController::class, 'destroy']);
