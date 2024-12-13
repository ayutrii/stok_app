<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\barangMasukController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\suplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login_proses']);

Route::middleware(['auth', 'cekLevel:superadmin,'])->group(function(){
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
      Route::controller(stokController::class)->group(function(){
         Route::get('/stok', 'index');

         Route::get('/stok/add', 'create');
         Route::post('/stok/add', 'store')->name('savestok');
         
         Route::get('/stok/edit/{id}', 'edit');
         Route::post('/stok/edit/{id}', 'edit', 'update');

      });

       /**
      * Ini route barang masuk
      */
      Route::controller(barangMasukController::class)->group(function(){
        Route::get('/barang-masuk', 'index');
        
        Route::get('/barang-masuk/add', 'create');
        Route::post('/barang-masuk/add','store');
        
        Route::get('/barang-masuk/{id}', 'destroy');
      });

       /**
      * Ini route barang keluar
      */

       /**
      * Ini route pelanggan
      */
      Route::controller(pelangganController::class)->group(function(){
        Route::get('/pelanggan', 'index');

        Route::get('/pelanggan/add', 'create');
        Route::post('pelanggan/add', 'store');

        Route::get('pelanggan/edit/{id}', 'edit');
        Route::post('pelanggan/edit/{id}', 'update');

        Route::get('/pelanggan/{id}', 'destroy');
      });

       /**
      * Ini route suplier
      */
      Route::controller(suplierController::class)->group(function(){
        Route::get('/suplier', 'index');

        Route::get('/suplier/add', 'create');
        Route::post('suplier/add', 'store');

        Route::get('suplier/edit/{id}', 'edit');
        Route::post('suplier/edit/{id}', 'update');

        Route::get('/suplier/{id}', 'destroy');
      });

      

     
});