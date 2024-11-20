<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonobankPaymentController;


Route::post('webhookmonobank', MonobankPaymentController::class)->name('mono.webhook');
