<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\tb_Ayudantes_controller;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\Tb_citaciones_controller;
use App\Http\Controllers\TbAyudanteController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ayudantes', [tb_Ayudantes_controller::class, 'index']);

Route::get('/instituciones', [InstitucionController::class, 'index']);
Route::get('/ListaInstituciones', [InstitucionController::class, 'listadoInsti']);
Route::get('/ListaInstitucionesActual', [InstitucionController::class, 'listadoInstiActial']);

Route::get('/Ayudantes_psi', [TbAyudanteController::class, 'MostraraPsi']);
Route::get('/Ayudantes_edu', [TbAyudanteController::class, 'MostrarEdu']);
Route::post('/CreateAyudantes', [TbAyudanteController::class, 'crearAyudante']);

Route::get('/Citaciones_psi', [Tb_citaciones_controller::class, 'CitacionesPsi']);
Route::post('/CreateCitacion', [Tb_citaciones_controller::class, 'CitacionesCrear']);