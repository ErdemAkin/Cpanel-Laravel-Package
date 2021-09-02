<?php

use Illuminate\Support\Facades\Route;
use Laravel\Cpanel\Http\Controllers\FtpController;

Route::prefix('ftp')->group(function () {

    Route::get('/', [FtpController::class, 'index'])->name('ftp.index');
    Route::post('/store', [FtpController::class, 'store'])->name('ftp.store');
});