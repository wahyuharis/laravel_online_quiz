<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthPesertaController;
use App\Http\Controllers\DaftarKuisController;
use App\Http\Controllers\DaftarPesertaController;
use App\Http\Controllers\DashAdminController;
use App\Http\Controllers\DashPesertaController;
use App\Http\Controllers\KelompokKuisController;
use App\Http\Controllers\KelompokPesertaController;
use App\Http\Middleware\NativeAuth_IsLogin;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [AuthAdminController::class, 'login']);
Route::post('admin/login_submit', [AuthAdminController::class, 'login_submit']);
Route::get('admin/logout', [AuthAdminController::class, 'logout']);

Route::middleware([NativeAuth_IsLogin::class])->group(function () {
    Route::get('admin/dash', [DashAdminController::class, 'index']);
    Route::get('admin/', [DashAdminController::class, 'index']);

    Route::get('admin/kelompok_peserta', [KelompokPesertaController::class, 'index']);
    Route::post('admin/kelompok_peserta/submit', [KelompokPesertaController::class, 'submit']);
    Route::get('admin/kelompok_peserta/delete', [KelompokPesertaController::class, 'delete']);

    Route::get('admin/daftar_peserta', [DaftarPesertaController::class, 'index']);
    Route::get('admin/daftar_peserta/edit', [DaftarPesertaController::class, 'edit']);
    Route::get('admin/daftar_peserta/add', [DaftarPesertaController::class, 'edit']);
    Route::post('admin/daftar_peserta/submit', [DaftarPesertaController::class, 'submit']);
    Route::get('admin/daftar_peserta/delete', [DaftarPesertaController::class, 'delete']);
    Route::get('admin/daftar_peserta/datatables', [DaftarPesertaController::class, 'datatables']);


    Route::get('admin/kelompok_kuis', [KelompokKuisController::class, 'index']);
    Route::get('admin/kelompok_kuis/datatables', [KelompokKuisController::class, 'datatables']);
    Route::get('admin/kelompok_kuis/add', [KelompokKuisController::class, 'edit']);
    Route::get('admin/kelompok_kuis/edit', [KelompokKuisController::class, 'edit']);
    Route::post('admin/kelompok_kuis/submit', [KelompokKuisController::class, 'submit']);
    Route::get('admin/kelompok_kuis/delete', [KelompokKuisController::class, 'delete']);

    Route::get('admin/daftar_kuis', [DaftarKuisController::class, 'index']);
    Route::get('admin/daftar_kuis/datatables', [DaftarKuisController::class, 'datatables']);
    Route::get('admin/daftar_kuis/add', [DaftarKuisController::class, 'edit']);
    Route::get('admin/daftar_kuis/edit', [DaftarKuisController::class, 'edit']);
    Route::post('admin/daftar_kuis/submit', [DaftarKuisController::class, 'submit']);
    Route::get('admin/daftar_kuis/delete', [DaftarKuisController::class, 'delete']);
});




//peserta
Route::get('peserta/login', [AuthPesertaController::class, 'login']);
Route::post('peserta/login_submit', [AuthPesertaController::class, 'login_submit']);
Route::get('peserta/dash', [DashPesertaController::class, 'index']);
