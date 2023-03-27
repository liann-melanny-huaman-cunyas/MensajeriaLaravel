<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::resource('chirps', ChirpController::class)
    /**La ruta "index" es para crear formularios y mostrar todas las publicaciones
     * La ruta "store" para guardar nuevas publicaciones
     * La ruta "edit" mostrara el formulario para editar
     * La ruta "update" aceptara los datos y actualizara el Model
     * */

    ->only(['index', 'store', 'edit', 'update'])
    //El middleware "auth" sirve para garantizar que solo son usuarios registrados
    //EL middleware "verified" sirve para verificar el correo electronico
    ->middleware(['auth', 'verified']);

    /**
     * EL HTTP "GET" && URL "/chirps" && Accion "index" && Route name "chirps.index"
     * EL HTTP "POST" && URL "/chirps" && Accion "store" && Route name "chirps.store"
     * El HTTP "GET" && URL "/chirps/{chirps}/edit" && Accion "edit" && Route name "chirps.edit"
     * EL HTTP "PUT/PATCH" && URL "/chirps/{chirps} && Accion "update" && Route name "chirps.update"
     */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
