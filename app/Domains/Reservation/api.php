<?php

use App\Domains\Reservation\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function () {
    Route::resource('reservations', ReservationController::class);
});
