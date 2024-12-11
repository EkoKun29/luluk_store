<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\CashDepositController;
use App\Http\Controllers\CashTransferController;
use App\Http\Controllers\DebtPaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\ReceivablePaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::middleware('role:admin')->group(function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::as('products')->apiResource('products/{product}/price', App\Http\Controllers\ProductPriceController::class)->parameters([
            'price' => 'productPrice'
        ]);
        Route::resource('banks', App\Http\Controllers\BankController::class);
        Route::get('/banks/{bank}/rekenings', [App\Http\Controllers\BankController::class, 'getRekenings'])->name('banks.rekenings');
        Route::resource('norekenings', App\Http\Controllers\NoRekeningController::class);

        Route::prefix('sales')
            ->as('sales.')
            ->controller(App\Http\Controllers\SaleController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::delete('/{sale}', 'destroy')->name('destroy');

                Route::prefix('cash')->as('cash.')->group(function () {
                    Route::get('/', 'cashIndex')->name('index');
                    Route::get('/create', 'cashCreate')->name('create');
                    Route::get('/{sale}/show', 'show')->name('show');
                });
                Route::prefix('receivable')->as('receivable.')->group(function () {
                    Route::get('/', 'receivableIndex')->name('index');
                    Route::get('/create', 'receivableCreate')->name('create');
                    Route::get('/{sale}/show', 'show')->name('show');
                });
                Route::prefix('transfer')->as('transfer.')->group(function () {
                    Route::get('/', 'transferIndex')->name('index');
                    Route::get('/create', 'transferCreate')->name('create');
                    Route::get('/{sale}/show', 'show')->name('show');
                });
            });

        Route::prefix('purchases')
            ->as('purchases.')
            ->controller(App\Http\Controllers\PurchaseController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::delete('/{purchase}', 'destroy')->name('destroy');

                Route::prefix('cash')->as('cash.')->group(function () {
                    Route::get('/', 'cashIndex')->name('index');
                    Route::get('/create', 'cashCreate')->name('create');
                    Route::get('/{purchase}/show', 'show')->name('show');
                });

                Route::prefix('debt')->as('debt.')->group(function () {
                    Route::get('/', 'debtIndex')->name('index');
                    Route::get('/create', 'debtCreate')->name('create');
                    Route::get('/{purchase}/show', 'show')->name('show');
                });

                Route::prefix('transfer')->as('transfer.')->group(function () {
                    Route::get('/', 'transferIndex')->name('index');
                    Route::get('/create', 'transferCreate')->name('create');
                    Route::get('/{purchase}/show', 'show')->name('show');
                });
            });

        Route::prefix('receivable-payments')
            ->as('receivable-payments.')
            ->controller(App\Http\Controllers\ReceivablePaymentController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::delete('/{receivablePayment}', 'destroy')->name('destroy');

                Route::prefix('cash')
                    ->as('cash.')
                    ->group(function () {
                        Route::get('/', 'cashIndex')->name('index');
                        Route::get('/create', 'cashCreate')->name('create');
                    });

                Route::prefix('transfer')
                    ->as('transfer.')
                    ->group(function () {
                        Route::get('/', 'transferIndex')->name('index');
                        Route::get('/create', 'transferCreate')->name('create');
                    });
            });

        Route::prefix('debt-payments')
            ->as('debt-payments.')
            ->controller(App\Http\Controllers\DebtPaymentController::class)
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::delete('/{debtPayment}', 'destroy')->name('destroy');

                Route::prefix('cash')
                    ->as('cash.')
                    ->group(function () {
                        Route::get('/', 'cashIndex')->name('index');
                        Route::get('/create', 'cashCreate')->name('create');
                    });

                Route::prefix('transfer')
                    ->as('transfer.')
                    ->group(function () {
                        Route::get('/', 'transferIndex')->name('index');
                        Route::get('/create', 'transferCreate')->name('create');
                    });
            });

        Route::resource('cash-deposits', CashDepositController::class);
        Route::resource('cash-transfer', CashTransferController::class);
        Route::resource('audits', AuditController::class);

        Route::prefix('report')->as('report.')->group(function () {
            Route::get('/sales', [SaleController::class, 'reportIndex'])->name('sales');
            Route::get('/sales/download', [SaleController::class, 'reportDownload'])->name('sales.download');

            Route::get('/purchases', [PurchaseController::class, 'reportIndex'])->name('purchases');
            Route::get('/purchases/download', [PurchaseController::class, 'reportDownload'])->name('purchases.download');

            Route::get('/receivable-payments', [ReceivablePaymentController::class, 'reportIndex'])->name('receivable-payments');
            Route::get('/receivable-payments/download', [ReceivablePaymentController::class, 'reportDownload'])->name('receivable-payments.download');

            Route::get('/debt-payments', [DebtPaymentController::class, 'reportIndex'])->name('debt-payments');
            Route::get('/debt-payments/download', [DebtPaymentController::class, 'reportDownload'])->name('debt-payments.download');
        });

        Route::get('sales/{sale}/print', [App\Http\Controllers\SaleController::class, 'print'])->name('sale.print');
        Route::get('purchases/{purchase}/print', [App\Http\Controllers\PurchaseController::class, 'print'])->name('purchase.print');

        Route::resource('cash-deposits', CashDepositController::class);
        Route::resource('cash-transfer', CashTransferController::class);
        Route::resource('audits', AuditController::class);

        Route::get('sales/{sale}/print', [App\Http\Controllers\SaleController::class, 'print'])->name('sale.print');
        Route::get('purchases/{purchase}/print', [App\Http\Controllers\PurchaseController::class, 'print'])->name('purchase.print');
    // });
});
