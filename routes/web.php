<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengaduanController;

// Arahkan halaman utama langsung ke daftar pengaduan
Route::get('/', fn() => redirect()->route('pengaduan.index'));

// Definisikan resource route untuk PengaduanController
Route::resource('pengaduan', PengaduanController::class)
->only(['index', 'create', 'store', 'update', 'destroy']);
