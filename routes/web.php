<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SiswaController;
use App\Models\Barang;
use App\Models\Ruangan;
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

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    Route::resource('roles', RoleController::class);
});
Route::middleware('auth')->group(function(){
    Route::resource('barang', BarangController::class);
    Route::get('table',[BarangController::class, 'table'])->name('data.table');
    Route::get('show/{id}',[BarangController::class, 'showbarang']);
    Route::get('barang/edit',[BarangController::class, 'update'])->name('barang.update');
    Route::get('hapus',[BarangController::class, 'hapus'])->name('hapus');
    Route::get('barang/input/{id}',[BarangController::class, 'input']);
    Route::get('barang/service/{id}',[BarangController::class, 'service']);
    Route::get('proses',[BarangController::class, 'proses'])->name('data.proses');
    Route::get('barang/create/{id}', [BarangController::class, 'create']);
    Route::get('barang/edit/{id}', [BarangController::class, 'editbanyak']);
    Route::get('barang/ubah/{id}',[BarangController::class, 'editbarang']);
    Route::get('cetak/{id}', [BarangController::class, 'cetak'])->name('barang.pdf');
    Route::get('cetakbarang', [BarangController::class, 'cetakbarang'])->name('barang.label');
});
Route::middleware('auth')->group(function(){
    Route::resource('ruangan', RuanganController::class);
    Route::delete('hapus_ruangan/{id}/delete', [RuanganController::class, 'destroy']);
    Route::get('ruangan/edit/{id}',[RuanganController::class, 'editruangan']);
    Route::get('ruangan/edit',[RuanganController::class, 'update'])->name('ruangan.update');
});
Route::middleware('auth')->group(function(){
    Route::resource('siswa', SiswaController::class);
    Route::get('siswa/status/{id}', [SiswaController::class ,'status'])->name('siswa.status');
    Route::get('siswa/password/{id}', [SiswaController::class, 'password'])->name('siswa.reset');
    Route::delete('hapus_siswa/{id}/delete', [SiswaController::class, 'destroy']);
    Route::get('siswa/edit/{id}',[SiswaController::class, 'editsiswa']);
    Route::get('siswa/edit',[RuanganController::class, 'update'])->name('siswa.update');
});
Route::middleware('auth')->group(function(){
    Route::resource('guru', GuruController::class);
    Route::get('guru/status/{id}', [GuruController::class ,'status'])->name('guru.status');
    Route::get('guru/password/{id}', [GuruController::class, 'password'])->name('guru.reset');
    Route::delete('hapus_guru/{id}/delete', [GuruController::class, 'destroy']);
    Route::get('guru/edit/{id}',[GuruController::class, 'editguru']);
    Route::get('guru/edit',[GuruController::class, 'update'])->name('guru.update');
});
Route::middleware('auth')->group(function(){
    Route::resource('kepsek', KepsekController::class);
    Route::get('kepsek/status/{id}', [KepsekController::class ,'status'])->name('kepsek.status');
    Route::get('kepsek/password/{id}', [KepsekController::class, 'password'])->name('kepsek.reset');
    Route::delete('hapus_kepsek/{id}/delete', [KepsekController::class, 'destroy']);
    Route::get('kepsek/edit/{id}',[KepsekController::class, 'editkepsek']);
    Route::get('kepsek/edit',[KepsekController::class, 'update'])->name('kepsek.update');
});
Route::middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user/password/{id}', [DashboardController::class, 'password'])->name('user.reset');
    Route::get('user/edit/{id}',[DashboardController::class, 'edituser']);
    Route::get('user/edit',[DashboardController::class, 'update'])->name('user.update');
});
Route::middleware('auth')->group(function(){
    Route::resource('sampah', SampahController::class);
    Route::get('sampahtable',[SampahController::class, 'sampah'])->name('sampah.table');
    Route::get('restoresampah/{id}', [SampahController::class ,'restore'])->name('sampah.restore');
    Route::delete('hapus_sampah/{id}/delete', [SampahController::class, 'destroy']);
});
Route::middleware('auth')->group(function(){
    Route::resource('service', ServiceController::class);
    Route::get('servicetable',[ServiceController::class, 'service'])->name('service.table');
    Route::get('restoreservice/{id}', [ServiceController::class ,'restore'])->name('service.restore');
});
Route::middleware('auth')->group(function(){
    Route::resource('pinjam', PinjamController::class);
    Route::get('Pinjamtable',[PinjamController::class, 'pinjam'])->name('pinjam.table');
    Route::get('pinjamkembali/{id}', [PinjamController::class ,'kembali'])->name('pinjam.kembali');
    Route::get('setuju/{id}', [PinjamController::class ,'setuju'])->name('pinjam.setuju');
    Route::get('tolak/{id}', [PinjamController::class ,'tolak'])->name('pinjam.tolak');
});
