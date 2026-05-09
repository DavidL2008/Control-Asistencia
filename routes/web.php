<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', App\Http\Controllers\RolController::class);
    Route::resource('usuarios', App\Http\Controllers\UsuarioController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('profesor', 'App\Http\Controllers\ProfesorController@obtenerProfesores')->name('profesor');
    Route::resource('profesor', App\Http\Controllers\ProfesorController::class);
    Route::resource('area', App\Http\Controllers\AreaController::class);
    Route::resource('cargo', App\Http\Controllers\CargoController::class);
    Route::resource('profesordetalle', App\Http\Controllers\ProfesorDetalleController::class);
    Route::resource('registro', App\Http\Controllers\RegistroController::class);
    Route::resource('escritorio', App\Http\Controllers\EscritorioController::class);
    Route::resource('horario', App\Http\Controllers\HorarioController::class);
    Route::resource('qr', App\Http\Controllers\QrController::class);
    Route::get('mostrar', [\App\Http\Controllers\RegistroController::class, 'mostrar'])->name('mostrar.mostrar');

    Route::post('/fetch-dni-data', [ApiController::class, 'fetchDniData'])->name('fetch-dni-data');

});

Route::get('generador-pdf', [App\Http\Controllers\PdfController::class, 'generarPdf'])->name('generar.pdf');

Route::get('generar-excel', [App\Http\Controllers\ExcelController::class, 'export'])->name('generar.excel');



Route::get('/connect', 'ZktecoController@connect');
Route::get('/disconnect', 'ZktecoController@disconnect');
Route::get('/zkateco', [App\Http\Controllers\ZktecoController::class, 'index'])->name('zkateco.index');
Route::post('/zkateco/connect', [App\Http\Controllers\ZktecoController::class, 'connect'])->name('zkateco.connect');


