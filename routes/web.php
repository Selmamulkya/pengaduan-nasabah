<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmpanBalikController;

Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk pengaduan nasabah (CRUD)
    Route::resource('complaints', ComplaintController::class);
    Route::post('/umpan-balik', [UmpanBalikController::class, 'store'])->name('umpan-balik.store');


    // Route tambahan khusus admin
    Route::middleware(['can:isAdmin'])->group(function () {
        // Route khusus admin bisa ditambahkan di sini
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
        Route::get('/rekap-umpan-balik', [UmpanBalikController::class, 'rekap'])->name('rekap.feedback');
    });
});

require __DIR__ . '/auth.php';
