<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Odc\OdcController;
use App\Http\Controllers\Odp\OdpController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Odc\OdcPortController;
use App\Http\Controllers\Odp\OdpPortController;
use App\Http\Controllers\Paket\PaketController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pelanggan\ProcessPelangganController;

// Public (no auth)
Route::get('/', fn() => ['Laravel' => app()->version()]);

// ========== Guest (belum login) ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.post')
        // ->middleware('throttle:login') // aktifkan kalau limiter siap
        ->middleware('web');
});

// ========== Authenticated (sudah login) ==========
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // -------- Pelanggan --------
    Route::prefix('dashboard/pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [PelangganController::class, 'index'])->name('index');
        Route::get('/tambah', [PelangganController::class, 'create'])->name('create');   // HARUS sebelum {id}
        Route::post('/tambah', [PelangganController::class, 'store'])->name('store');

        Route::get('/edit/{id}',  [PelangganController::class, 'edit'])
            ->whereUuid('id')->name('edit');

        Route::post('/edit/{id}', [PelangganController::class, 'update'])
            ->whereUuid('id')->name('update');

        Route::get('/{id}', [PelangganController::class, 'show'])
            ->whereUuid('id') // jika tidak ada helper whereUuid, pakai ->where('id', '[0-9a-fA-F-]{36}')
            ->name('show');

        Route::get('/process/{id}', [ProcessPelangganController::class, 'create'])
            ->whereUuid('id')
            ->name('process.create');

        Route::post('/process/{id}', [ProcessPelangganController::class, 'store'])
            ->whereUuid('id')
            ->name('process.store');

        Route::post('/delete/{id}', [PelangganController::class, 'softDelete'])
            ->whereUuid('id')
            ->name('delete');
    });

    // ===== ODP (master) =====
    Route::prefix('dashboard/odp')->name('odp.')->group(function () {
        Route::get('/', [OdpController::class, 'index'])->name('index');
        Route::get('/tambah', [OdpController::class, 'create'])->name('create');
        Route::post('/tambah', [OdpController::class, 'store'])->name('store');
        Route::get('/{id}', [OdpController::class, 'show'])
            ->whereUuid('id')
            ->name('show');
    });

    // ===== ODP Port =====
    Route::get('/dashboard/odp-port/{id}', [OdpPortController::class, 'create'])
        ->whereUuid('id')
        ->name('odp_port.create');
    Route::post('/dashboard/odp-port/{id}', [OdpPortController::class, 'store'])
        ->whereUuid('id')
        ->name('odp_port.store');

    Route::get('/dashboard/odp-port/edit/{id}', [OdpPortController::class, 'edit'])
        ->whereUuid('id')
        ->name('odp_port.edit');

    Route::post('/dashboard/odp-port/edit/{id}', [OdpPortController::class, 'update'])
        ->whereUuid('id')
        ->name('odp_port.update');

    // ===== Paket =====
    Route::prefix('dashboard/paket')->name('paket.')->group(function () {
        Route::get('/', [PaketController::class, 'index'])->name('index');
        Route::get('/tambah', [PaketController::class, 'create'])->name('create');
        Route::post('/tambah', [PaketController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PaketController::class, 'edit'])->whereUuid('id')->name('edit');
        Route::post('/edit/{id}', [PaketController::class, 'update'])->whereUuid('id')->name('update');
    });

    // ===== Server =====
    Route::prefix('dashboard/server')->name('server.')->group(function () {
        Route::get('/', [ServerController::class, 'index'])->name('index');
        Route::get('/tambah', [ServerController::class, 'create'])->name('create');
        Route::post('/tambah', [ServerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServerController::class, 'edit'])->whereUuid('id')->name('edit');
        Route::post('/edit/{id}', [ServerController::class, 'update'])->whereUuid('id')->name('update');
    });

    // ===== ODC =====
    Route::prefix('dashboard/odc')->name('odc.')->group(function () {
        Route::get('/', [OdcController::class, 'index'])->name('index');
        Route::get('/tambah', [OdcController::class, 'create'])->name('create');
        Route::post('/tambah', [OdcController::class, 'store'])->name('store');
        Route::get('/{id}', [OdcController::class, 'show'])
            ->whereUuid('id')
            ->name('show');
        Route::get('/edit/{id}', [OdcController::class, 'edit'])
            ->whereUuid('id')
            ->name('edit');
        Route::post('/edit/{id}', [OdcController::class, 'update'])
            ->whereUuid('id')
            ->name('update');
    });
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Form tambah port untuk ODC tertentu
    Route::get('/dashboard/odc-port/{id}', [OdcPortController::class, 'create'])
        ->whereUuid('id')
        ->name('odc_port.create');

    // Simpan port untuk ODC tertentu
    Route::post('/dashboard/odc-port/{id}', [OdcPortController::class, 'store'])
        ->whereUuid('id')
        ->name('odc_port.store');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // EDIT port ODC berdasarkan ID port
    Route::get('/dashboard/odc-port/edit/{id}', [OdcPortController::class, 'edit'])
        ->whereUuid('id')
        ->name('odc_port.edit');

    Route::post('/dashboard/odc-port/edit/{id}', [OdcPortController::class, 'update'])
        ->whereUuid('id')
        ->name('odc_port.update');
});
