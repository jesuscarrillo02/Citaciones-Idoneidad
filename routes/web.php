<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/Institucines_educativa/ayudantes_institucion', function () {
    return Inertia::render('AyudantesPsi');
})->name('AyudantesPsi');

Route::get('/dashboard/Institucines_educativas', function () {
    return Inertia::render('Instituciones_edu');
})->name('Inst_edu');

Route::get('/dashboard/Institucion_edu/Ayudantes_per', function () {
    return Inertia::render('AyudantesEdu');
})->name('AyudantesEdu');

Route::get('/dashboard/Institucines_educativasayudantes_institucion/CitacionePsi', function () {
    return Inertia::render('CitacionePsi');
})->name('Citacion_Psi');

Route::get('/dashboard/Institucion_edu/Ayudantes_per/citaciones_ayu', function () {
    return Inertia::render('CitacionesPendientes');
})->name('CitacionesPendientes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
