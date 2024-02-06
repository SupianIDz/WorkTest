<?php

use App\Domains\User\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('signin', [AuthController::class, 'signin'])->name('auth.signin');
});
