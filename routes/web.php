<?php

use App\Http\Controllers\controllerTickets;
use App\Http\Controllers\controllerUsuarios;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;

Route::get('/', function () {
    return view('auth.login');
});






Route::get('/dashboard', function () {
    $tickets = Ticket::all();
    return view('dashboard',compact('tickets'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

///// RUTAS DE USUARIOS ////
Route::get('/verUsuarios',  [controllerUsuarios::class,'index'])->name('verUsuarios');
Route::delete('/usuarios/{id}', [controllerUsuarios::class, 'destroy'])->name('delUsuarios');



///// RUTAS DE TICKETS ////
Route::get('/crearNuevoTicket',  [controllerTickets::class,'vistaCrearTicket'])->name('vistaCrearTicket');
Route::post('/NuevoTicket',  [controllerTickets::class,'CrearTicket'])->name('CrearTicket');
Route::get('/ticket/{id}', [controllerTickets::class, 'show'])->name('ticket')->middleware(['auth', 'verified']);
Route::delete('/ticketdel/{id}', [controllerTickets::class, 'destroy'])->name('delTicket');
Route::get('/ticketID/{id}', [controllerTickets::class, 'ticketid'])->name('ticketid');








});

require __DIR__.'/auth.php';
