<?php

use App\Common\Enums\RouteName;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\WalletController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register'])->name(RouteName::REGISTER);
Route::post('login', [LoginController::class, 'login'])->name(RouteName::LOGIN);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('wallet/topup', [WalletController::class, 'topup'])->name(RouteName::TOPUP);
    Route::post('wallet/transfer', [WalletController::class, 'transfer'])->name(RouteName::TRANSFER);
    Route::get('wallet/balance', [WalletController::class, 'checkBalance'])->name(RouteName::BALANCE);
    Route::get('wallet/transactions', [WalletController::class, 'transactionHistory'])->name(RouteName::TRANSACTIONS);
    //logout
    Route::post('logout', [LoginController::class, 'logout'])->name(RouteName::LOGOUT);
});
