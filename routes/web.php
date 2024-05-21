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
use App\Http\Controllers\EventoController;
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', [EventoController::class, "index"]);
Route::get('/index', [EventoController::class, "index"]);

Route::get('/events/create', [EventoController::class, "create"])->middleware("auth");
Route::post('/events', [EventoController::class, "store"]);
// Route::get('/produtos', function () {
//     return view('produtos');
// });
Route::delete('/events/{id}', [EventoController::class, 'destroy'])->middleware("auth");
Route::get('/events/{id}', [EventoController::class, 'show']);
Route::get('/events/edit/{id}', [EventoController::class, 'edit'])->middleware("auth");
Route::put('/events/update/{id}', [EventoController::class, 'update'])->middleware("auth");
Route::post('events/join/{id}', [EventoController::class, 'joinevent'])->middleware("auth");
Route::delete('events/leave/{id}', [EventoController::class, 'leaveevent'])->middleware("auth");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [EventoController::class, "index"]);
});

Route::get('/dashboard', [EventoController::class, "dashboard"])->middleware("auth");

