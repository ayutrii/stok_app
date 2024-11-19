<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pegawaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login_proses']);

Route::middleware(['auth', 'cekLevel:superadmin,admin'])->group(function(){
    /**
     * ini routing tombol logout!
     */
    Route::get('/logout', [AuthController::class, 'logout']);

    /**
     * ini routing dashboard controller!
     */
    Route::get('/dashboard', [dashboardController::class, 'index']);

     /**
      * Ini route stok
      */

       /**
      * Ini route barang masuk
      */

       /**
      * Ini route barang keluar
      */

       /**
      * Ini route pelanggan
      */

       /**
      * Ini route suplier
      */
    
    /** 
     * ini routing untuk pegawai controller!
     */
    Route::controller(pegawaiController::class)->group(function(){

        Route::get('/pegawai', 'index');

        Route::post('/pegawai/add', 'store')->name('savePegawai');

        Route::get('/pegawai/edit/{id}', 'edit'); 
        Route::post('/pegawai/edit/{id}', 'update'); 

        Route::get('/pegawai/{id}', 'destroy');
        
    });

     
});