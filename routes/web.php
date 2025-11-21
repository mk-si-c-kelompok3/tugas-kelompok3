<?php

use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

// kalau buka root, langsung ke pengaduan
Route::get('/', function () {
    return redirect()->route('pengaduan.index');
});

// semua route di bawah ini wajib login & verified
Route::middleware(['auth', 'verified'])->group(function () {

    // dashboard breeze default, kita arahkan ke pengaduan juga
    Route::get('/dashboard', function () {
        return redirect()->route('pengaduan.index');
    })->name('dashboard');

    // ==== ROUTE PENGADUAN YANG BOLEH DIAKSES SEMUA USER LOGIN ====

    Route::get('/pengaduan', [PengaduanController::class, 'index'])
        ->name('pengaduan.index');

    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])
        ->name('pengaduan.create');

    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->name('pengaduan.store');

    // ==== ROUTE KHUSUS ADMIN (UPDATE & DELETE PENGADUAN) ====

    Route::middleware('admin')->group(function () {
        Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])
            ->name('pengaduan.update');

        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])
            ->name('pengaduan.destroy');

            Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])
            ->name('pengaduan.show')
            ->middleware('role:admin'); // kalau detail khusus admin

    });
});

require __DIR__.'/auth.php';
