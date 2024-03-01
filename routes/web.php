<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PlacaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	/*Route::get('placa', function () {
		return view('placas/index');
	})->name('placa');*/

	Route::get('/placa', [PlacaController::class, 'index'])->name('placa.index');

	Route::get('reporte', function () {
		return view('reporte');
	})->name('reporte');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/anexo', [InfoUserController::class, 'create']);
	Route::post('/anexo', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

//Consultas AJAX
Route::post('/importar-csv-placa', [PlacaController::class, 'importarCSV']);
Route::get('/listar-placas', [PlacaController::class, 'obtenerDatos']);
Route::get('/buscar-cod-estudiante/{codigo}', [PlacaController::class, 'buscarRegistro']);
Route::delete('/eliminar-registro/{codigo}', [PlacaController::class, 'eliminarRegistro']);


//Generando PDF

Route::get('/generar-pdf', [PdfController::class, 'generarPdf']);


