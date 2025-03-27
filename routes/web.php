<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LokasiKerjaController;
use App\Http\Controllers\KetidakhadiranController;
use App\Models\Ketidakhadiran;

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
    return view('welcome');
});
Route::get('/login', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::resource('karyawans', KaryawanController::class);
Route::get('getKaryawans', [KaryawanController::class, 'getData'])->name('karyawans.getData');

Route::prefix('absens')->name('absens.')->group(function () {
    Route::get('data', [AbsenController::class, 'data'])->name('data');
    Route::post('calculateDistance', [AbsenController::class, 'calculateDistance'])->name('calculateDistance');
    Route::get('getAbsens', [AbsenController::class, 'getData'])->name('absens.getData');
    Route::resource('/', AbsenController::class)->parameters(['' => 'absen']);
});

Route::prefix('lokasikerjas')->name('lokasikerjas.')->group(function () {
    Route::resource('/', LokasiKerjaController::class)->parameters(['' => 'lokasikerja']);
});
Route::get('getLokasiKerjas', [LokasiKerjaController::class, 'getData'])->name('lokasikerjas.getData');

Route::prefix('ketidakhadirans')->name('ketidakhadirans.')->group(function () {
    Route::get('data', [KetidakhadiranController::class, 'data'])->name('data');
    Route::get('approve', [KetidakhadiranController::class, 'approve'])->name('approve');
    Route::get('getKetidakhadiranSelf', [KetidakhadiranController::class, 'getDataSelf'])->name('lokasikerjas.getDataSelf');
    Route::get('getKetidakhadiranAll', [KetidakhadiranController::class, 'getDataAll'])->name('lokasikerjas.getDataAll');
    Route::resource('/', KetidakhadiranController::class)->parameters(['' => 'ketidakhadiran']);
});
