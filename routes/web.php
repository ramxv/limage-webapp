<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\users\CitasController;
use App\Http\Controllers\users\ServiciosPageController;
use App\Http\Controllers\users\PromocionesPageController;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/citas', [AdminController::class, 'citas'])->name('admin.citas');
Route::get('/admin/promociones', [AdminController::class, 'promociones'])->name('admin.promociones');
Route::get('/admin/transacciones', [AdminController::class, 'transacciones'])->name('admin.transaccion.create');
Route::get('/admin/comprobante', [AdminController::class, 'comprobante'])->name('admin.comprobante');
Route::get('/admin/reporte', [AdminController::class, 'reporte'])->name('admin.reporte');
Route::get('/admin/servicios', [AdminController::class, 'servicios'])->name('admin.servicio.create');
Route::post('admin/comprobante/{id}/enviar', [AdminController::class, 'enviarComprobante'])->name('admin.enviarComprobante');
Route::post('reportes/financieros', [AdminController::class, 'generarPDF'])->name('admin.generarPDF');
Route::post('reportes/financieros/consultar', [AdminController::class, 'consultarReporte'])->name('admin.consultarReporte');
Route::get('/admin/txempleado', [AdminController::class, 'transaccionEmpleado'])->name('admin.txempleado');

Route::get('transaccion/create', [TransaccionController::class, 'create'])->name('transaccion.create');
Route::post('transaccion', [TransaccionController::class, 'store'])->name('transaccion.store');

Route::get('servicio/create', [ServicioController::class, 'create'])->name('servicio.create');
Route::post('servicio', [ServicioController::class, 'store'])->name('servicio.store');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard')->middleware('user');

Route::get('/admin/citas', [CitaController::class, 'index'])->name('admin.citas');

Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones.index');
Route::post('/promociones', [PromocionController::class, 'store'])->name('promociones.store');
Route::delete('/promociones/{promocion}', [PromocionController::class, 'destroy'])->name('promociones.destroy');


/*agendar cita rutas*/
Route::get('users/agendar-cita', [CitasController::class, 'create'])->name('users.agendarCita');
Route::get('/users/agendarCita', [CitasController::class, 'showForm'])->name('agendarCita');
Route::post('/submit-form', [CitasController::class, 'submitForm'])->name('submitForm');

/*pagina de servicios rutas*/
Route::get('users/servicio', [ServiciosPageController::class,'create'])->name('users.servicios');

/*pagina de promociones*/
Route::get('users/promociones', [PromocionesPageController::class, 'create'])->name('users.promociones');
