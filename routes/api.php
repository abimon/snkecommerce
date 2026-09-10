<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::controller(StoreController::class)->group(function () {
    Route::get('/payments/callback/{id}', 'Callback');
});
