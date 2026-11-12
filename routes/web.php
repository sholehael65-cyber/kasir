<?php
use App\Http\Controllers\Owner\PasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


// Route Halaman Admin (Dilindungi middleware isAdmin)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [OwnerController::class, 'index'])->name('owner.index');
});

// Route Halaman User (Dilindungi middleware isUser)
Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/user', [KasirController::class, 'index'])->name('kasir.index');
});

Route::get('/data-kategori', function () {
    return view('kategori.index');
});

// Route untuk Data Barang
Route::get('/data-barang', function () {
    return view('barang.index');
});

Route::get('/transaksi-pos', function () {
    return view('kasir.transaksi');
})->name('transaksi.pos');

Route::get('/barang-masuk', function () {
       return view('barang.masuk');
   })->name('barang.masuk');


   Route::get('/laporan-keuangan', function () {
       return view('laporan.keuangan');
   })->name('laporan.keuangan');


   Route::get('/arus-kas', function () {
    return view('laporan.arus-kas');
     })->name('arus.kas');

     Route::get('/kelola-kasir', function () {
       return view('Owner.kelola-kasir');
   })->name('kelola.kasir');


   Route::get('/pengaturan', function () {
    return view('pengaturan.index');
})->name('pengaturan.index');



// Rute Dashboard Owner
Route::get('/dashboard-owner', function () {
    return view('Owner.index');
})->name('owner.dashboard');

// Rute Dashboard Kasir
Route::get('/dashboard-kasir', function () {
    return view('kasir.dashboard');
})->name('kasir.dashboard');

// Rute Dashboard Utama / Home
Route::get('/dashboard', function () {
    return view('Owner.index'); // Default diarahkan ke dashboard utama
})->name('home');

Route::middleware(['auth', 'isOwner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');

    // Halaman Pengaturan & Reset Password
    Route::get('/pengaturan', [PasswordController::class, 'index'])->name('pengaturan');
    Route::put('/pengaturan/password-saya', [PasswordController::class, 'updateSelf'])->name('password.updateSelf');
    Route::put('/pengaturan/reset-kasir/{id}', [PasswordController::class, 'resetKasir'])->name('password.resetKasir');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
