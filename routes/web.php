<?php

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/wallet/top-up', [WalletController::class, 'showTopUpForm'])->name('wallet.topUpForm');
    Route::post('/wallet/top-up', [WalletController::class, 'topUp'])->name('wallet.topUp');
    Route::get('/wallet/transfer', [WalletController::class, 'showTransferForm'])->name('wallet.transferForm');
    Route::post('/wallet/transfer', [WalletController::class, 'transfer'])->name('wallet.transfer');
    Route::get('/wallet/transactions', [WalletController::class, 'transactionHistory'])->name('wallet.transactions');
});
