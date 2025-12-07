<?php


use App\Mail\TestEmail;
use App\Services\RadiusAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Odc\OdcController;
use App\Http\Controllers\Odp\OdpController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Odc\OdcPortController;
use App\Http\Controllers\Odp\OdpPortController;
use App\Http\Controllers\Paket\PaketController;
use App\Http\Controllers\Sales\SalesController;

use App\Http\Controllers\Team\InviteController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\Ticket\HomeConController;
use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Pelanggan\IsolirController;

use App\Http\Controllers\Billing\ManualPayController;
use App\Http\Controllers\Pelanggan\UnisolirController;
use App\Http\Controllers\Pelanggan\PelangganController;

use App\Http\Controllers\Partner\AdminPartnerController;
use App\Http\Controllers\Partner\ClientDetailController;
use App\Http\Controllers\UserBilling\UserAuthController;
use App\Http\Controllers\Partner\ClientAddUserController;
use App\Http\Controllers\Partner\ClientPartnerController;
use App\Http\Controllers\UserRegist\UserRegistController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\UserRegist\AdminRegistController;
use App\Http\Controllers\UserBilling\UserSuspendController;
use App\Http\Controllers\Partner\ClientSearchDataController;
use App\Http\Controllers\UserBilling\UserAddEmailController;
use App\Http\Controllers\UserBilling\UserPayPointController;
use App\Http\Controllers\Partner\ClientEditProfileController;
use App\Http\Controllers\Partner\ClientTransactionController;
use App\Http\Controllers\UserBilling\UserDashboardController;
use App\Http\Controllers\UserReferral\UserReferralController;
use App\Http\Controllers\Partner\ClientProcessPointController;
use App\Http\Controllers\Partner\UserSuspendPartnerController;
use App\Http\Controllers\Pelanggan\ProcessPelangganController;
use App\Http\Controllers\UserBilling\UserAddPaymentController;
use App\Http\Controllers\UserReferral\AdminReferralController;
use App\Http\Controllers\PelangganCsr\CsrController;
use App\Http\Controllers\PelangganCsr\ProcessCsrController;

use App\Http\Controllers\UserBilling\UserTransactionController;
use App\Http\Controllers\Partner\AdminProspectPartnerController;
use App\Http\Controllers\Partner\ClientProcessPaymentController;

use App\Http\Controllers\Komisi\SalesKomisiController;



// Public (no auth)
Route::redirect('/', '/admin/login');

// ========== Guest (belum login) ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.post')
        // ->middleware('throttle:login') // aktifkan kalau limiter siap
        ->middleware('web');
});

Route::prefix('admin')->middleware('guest')->name('admin.')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
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

        Route::post('/isolir/{id}', IsolirController::class)
            ->whereUuid('id')
            ->name('isolir');

        Route::post('/unisolir/{id}', UnisolirController::class)
            ->whereUuid('id')
            ->name('unisolir');


        Route::post('/delete/{id}', [PelangganController::class, 'softDelete'])
            ->whereUuid('id')
            ->name('delete');

        Route::post('/inactive/{id}', [\App\Http\Controllers\Pelanggan\InactiveController::class, 'softDelete'])
            ->whereUuid('id')
            ->name('inactive');

        Route::delete('/hapus-foto/{id}', [PelangganController::class, 'hapusFoto'])
            ->whereUuid('id')
            ->name('hapus-foto');
    });

    // ===== ODP (master) =====
    Route::prefix('dashboard/odp')->name('odp.')->group(function () {
        Route::get('/', [OdpController::class, 'index'])->name('index');
        Route::get('/tambah', [OdpController::class, 'create'])->name('create');
        Route::post('/tambah', [OdpController::class, 'store'])->name('store');
        Route::get('/{id}', [OdpController::class, 'show'])
            ->whereUuid('id')
            ->name('show');
        Route::get('/edit/{id}', [OdpController::class, 'edit'])
            ->whereUuid('id')
            ->name('edit');

        Route::post('/edit/{id}', [OdpController::class, 'update'])
            ->whereUuid('id')
            ->name('update');
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

    // ===== Billing 1 =====

    Route::prefix('dashboard/billing')
        ->name('billing.')
        ->middleware(['auth', 'role:Admin,Finance,CustomerCare'])
        ->group(function () {
            Route::get('/', [BillingController::class, 'index'])->name('index');
            Route::get('/{id}', [BillingController::class, 'detail'])->name('detail');
        });

    // ===== Billing 2 =====

    Route::prefix('dashboard/billing')
        ->name('billing.')
        ->middleware(['auth', 'role:Admin,Finance'])
        ->group(function () {
            Route::get('/pay/{id}', [ManualPayController::class, 'pay'])->name('pay');
            Route::delete('/{id}', [BillingController::class, 'softDelete'])->name('soft_delete');
        });

    // ===== Team  =====

    Route::prefix('dashboard/team')
        ->name('team.')
        ->middleware(['auth', 'role:Admin'])
        ->group(function () {
            Route::get('/', [InviteController::class, 'index'])->name('index');
            Route::get('/tambah', [InviteController::class, 'create'])->name('create');
            Route::post('/tambah', [InviteController::class, 'store'])->name('store');

            Route::get('/edit/{id}', [InviteController::class, 'edit'])->whereUuid('id')->name('edit');
            Route::post('/edit/{id}', [InviteController::class, 'update'])->whereUuid('id')->name('update');
        });

    Route::prefix('dashboard/team')
        ->name('team.')
        ->group(function () {
            Route::get('/new-password', [InviteController::class, 'showNewPasswordForm'])->name('new_password.form');
            Route::post('/new-password', [InviteController::class, 'updatePassword'])->name('new_password.update');
        });

    // ===== Ticket  =====

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/ticket', [\App\Http\Controllers\Ticket\ComplianceController::class, 'index'])->name('ticket.index');
        // Route::get('/ticket/tambah', [\App\Http\Controllers\Ticket\ComplianceController::class, 'create'])->name('ticket.create');
        Route::get('/ticket/tambah/{id}', [\App\Http\Controllers\Ticket\ComplianceController::class, 'create'])->name('ticket.create');
        Route::post('/ticket/tambah', [\App\Http\Controllers\Ticket\ComplianceController::class, 'store'])->name('ticket.store');
        Route::get('/ticket/{id}/edit', [\App\Http\Controllers\Ticket\ComplianceController::class, 'edit'])->name('ticket.edit');
        Route::put('/ticket/{id}/update', [\App\Http\Controllers\Ticket\ComplianceController::class, 'update'])->name('ticket.update');
    });

    // === Ticket Instlasi Home Connection ====
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/ticket-hc', [HomeConController::class, 'index'])->name('ticket_hc.index');
        Route::get('/ticket-hc/tambah/{id}', [HomeConController::class, 'create'])->whereUuid('id')->name('ticket_hc.create');
        Route::post('/ticket-hc/store', [HomeConController::class, 'store'])->name('ticket_hc.store');

        Route::get('/ticket-hc/edit/{id}', [HomeConController::class, 'edit'])->whereUuid('id')->name('ticket_hc.edit');
        Route::put('/ticket-hc/update/{id}', [HomeConController::class, 'update'])->whereUuid('id')->name('ticket_hc.update');
    });

    // ===== Komisi Sales  =====

    Route::prefix('dashboard/komisi-sales')->name('komisi_sales.')->group(function () {
        Route::get('/', [SalesKomisiController::class, 'index'])->name('index');
    });


    // ===== Referral  =====

    Route::prefix('dashboard/referral')->name('referral.')->group(function () {
        Route::get('/', [AdminReferralController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [AdminReferralController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [AdminReferralController::class, 'update'])->name('update');
    });

    // ===== User Regist  =====
    Route::prefix('dashboard/user-regist')->name('userregist.')->group(function () {
        Route::get('/', [AdminRegistController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [AdminRegistController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [AdminRegistController::class, 'update'])->name('update');
    });

    // ===== Anggota Mitra  =====
    Route::prefix('dashboard/mitra')->name('partner.')->group(function () {
        Route::get('/', [AdminPartnerController::class, 'index'])->name('index');
        Route::get('/tambah', [AdminPartnerController::class, 'create'])->name('create');
        Route::post('/tambah', [AdminPartnerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminPartnerController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [AdminPartnerController::class, 'update'])->name('update');
    });

    // ===== Team Sales  =====
    Route::prefix('dashboard/sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::get('/tambah', [SalesController::class, 'create'])->name('create');
        Route::post('/tambah', [SalesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SalesController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SalesController::class, 'update'])->name('update');
    });


    // ===== data Prospek dari Mitra  =====
    Route::prefix('dashboard/list-prospek-mitra')
        ->name('list-prospek-mitra.')
        ->group(function () {
            Route::get('/', [AdminProspectPartnerController::class, 'index'])->name('user_partner.index');
            Route::get('/edit/{id}', [AdminProspectPartnerController::class, 'edit'])->name('user_partner.edit');
            Route::post('/edit/{id}', [AdminProspectPartnerController::class, 'update'])->name('user_partner.update');
        });

    // ===== data Pelanggan CSR  =====
    Route::prefix('dashboard/pelanggan-csr')->name('pelanggan_csr.')->group(function () {
        Route::get('/', [CsrController::class, 'index'])->name('index');
        Route::get('/tambah', [CsrController::class, 'create'])->name('create');
        Route::post('/tambah', [CsrController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CsrController::class, 'edit'])->whereUuid('id')->name('edit');
        // Route::post('/edit/{id}', [CsrController::class, 'update'])->whereUuid('id')->name('update');
        Route::put('/edit/{id}', [CsrController::class, 'update'])->name('update');

        Route::post('/inactive/{id}', [ProcessCsrController::class, 'inactive'])->name('inactive');
        Route::post('/isolir/{id}', [ProcessCsrController::class, 'isolirCsr'])->name('isolirCsr');

        Route::post('/delete-image/{id}', [CsrController::class, 'deleteImage'])->name('deleteImage');
    });

    // ===== Setting  =====
    Route::prefix('dashboard/setting')
        ->name('setting.')
        ->middleware(['auth', 'role:Admin,Finance'])
        ->group(function () {
            Route::get('/', [SettingController::class, 'edit'])->name('edit');
            Route::put('/', [SettingController::class, 'update'])->name('update');
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

// Routes Untuk Pelanggan 
Route::get('/pelanggan', [UserAuthController::class, 'showStep1'])->name('client.auth.step1');
Route::post('/pelanggan', [UserAuthController::class, 'processStep1'])->name('client.auth.step1.submit');


Route::get('/pelanggan/verification', [UserAuthController::class, 'showStep2'])->name('client.auth.step2');
Route::post('/pelanggan/verification', [UserAuthController::class, 'processStep2'])->name('client.auth.step2.submit');

Route::middleware('client.auth')->group(function () {
    Route::get('/pelanggan/dashboard', [UserDashboardController::class, 'index'])->name('client.dashboard');
    Route::post('/pelanggan/logout', [UserAuthController::class, 'logout'])->name('client.logout');

    Route::get('/pelanggan/selectpayment', [UserDashboardController::class, 'selectPayment'])->name('client.selectpayment');

    Route::get('/pelanggan/payment/{id}', [UserAddPaymentController::class, 'process'])->name('billing.payment.process');

    Route::get('/pelanggan/transaksi', [UserTransactionController::class, 'index'])->name('client.transaksi.index');
    Route::get('/pelanggan/transaksi/{id}', [UserTransactionController::class, 'show'])->name('client.transaksi.show');

    Route::get('/pelanggan/daftar-email', [UserAddEmailController::class, 'showForm'])->name('client.add_email');
    Route::post('/pelanggan/daftar-email', [UserAddEmailController::class, 'storeEmail'])->name('client.add_email.store');

    Route::get('/pelanggan/referral', [UserReferralController::class, 'index'])->name('client.referral.index');
    Route::get('/pelanggan/referral/tambah', [UserReferralController::class, 'create'])->name('client.referral.create');
    Route::post('/pelanggan/referral/tambah', [UserReferralController::class, 'store'])->name('client.referral.store');
    Route::get('/pelanggan/paywithpoint', [UserPayPointController::class, 'process'])->name('client.paywithpoint');

    Route::get('/pelanggan/suspend/{id}', [UserSuspendController::class, 'suspend'])->name('client.suspend');

    Route::post('/pelanggan/redeem-point', [UserPayPointController::class, 'redeemPoint'])->name('client.billing.redeempoint');
});

// Routes Untuk Pelanggan End

// Routes Untuk Mitra 
Route::prefix('mitra')->group(function () {
    Route::get('/token/{secret_token}', [ClientPartnerController::class, 'loginWithToken'])->name('partner.login.token');
    Route::get('/', [ClientPartnerController::class, 'showLoginForm'])->name('partner.login');
    Route::post('/', [ClientPartnerController::class, 'login'])->name('partner.login.process');

    Route::middleware('mitra')->group(function () {
        Route::get('/dashboard', [ClientPartnerController::class, 'dashboard'])->name('partner.dashboard');
        Route::post('/cari-tagihan', [ClientPartnerController::class, 'checkBillingByNoHP'])->name('partner.dashboard.searchBilling');
        Route::get('/user-tagihan/{no_hp}', [ClientSearchDataController::class, 'showBilling'])->name('partner.user.billing');
        Route::get('/proses-tagihan/{merchant_ref}', [ClientProcessPaymentController::class, 'showForm'])->name('partner.process.form');
        Route::post('/proses-tagihan/{merchant_ref}', [ClientProcessPaymentController::class, 'processPayment'])->name('partner.process.submit');
        Route::get('/point-payment', [ClientSearchDataController::class, 'showPointPayment'])->name('partner.point.payment');

        Route::get('/client', [ClientAddUserController::class, 'index'])->name('partner.add_client');
        Route::get('/client/{id}', [ClientDetailController::class, 'show'])->name('partner.client.detail');

        Route::get('/add-client', [ClientAddUserController::class, 'create'])->name('add_client.create');
        Route::post('/add-client', [ClientAddUserController::class, 'store'])->name('partner.add_client.store');

        Route::get('/user-suspend/{id}', [UserSuspendPartnerController::class, 'show'])->name('partner.user_suspend');
        Route::get('/user-suspend/proses/{id}', [UserSuspendPartnerController::class, 'process'])->name('partner.user_suspend.process');
        Route::get('/select-payment/{id}', [UserSuspendPartnerController::class, 'selectpayment'])->name('partner.user_suspend.select');
        Route::post('/create-payment/{merchant_ref}', [UserSuspendPartnerController::class, 'paymentprocess'])->name('partner.user_suspend.paymentprocess');


        Route::get('/detail-payment/{merchant_ref}', [ClientProcessPaymentController::class, 'showDetail'])
            ->name('partner.payment.detail');
        Route::get('/transaksi', [ClientTransactionController::class, 'index'])
            ->name('partner.transaksi');
        Route::post('/proses-point/{merchant_ref_id}', [ClientProcessPointController::class, 'store'])->name('partner.process.point');
        Route::post('/konfirmasi-transfer/{merchant_ref}', [ClientProcessPaymentController::class, 'confirmTransfer'])
            ->name('partner.transfer.confirm');

        Route::get('/edit-account', [ClientEditProfileController::class, 'edit'])->name('partner.edit');
        Route::post('/nonaktifkan-akun', [ClientEditProfileController::class, 'deactivate'])->name('partner.deactivate');

        Route::post('/logout', [ClientPartnerController::class, 'logout'])->name('partner.logout');
    });
});
// Routes Untuk Mitra End


// Routes Untuk User public

Route::get('/registrasi', [UserRegistController::class, 'index'])->name('client.regist');
// Route::post('/registrasi', [UserRegistController::class, 'store'])->name('client.regist.store');
Route::post('/registrasi', [UserRegistController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('client.regist.store');
Route::get('/registrasi/success', [UserRegistController::class, 'success'])->name('client.regist.success');
// Routes Untuk User public End

Route::get('/refresh-csrf', function () {
    return csrf_token();
});
