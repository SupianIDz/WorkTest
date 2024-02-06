<?php

use App\Domains\Table\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tables', 'middleware' => 'api'], function () {
    Route::get('availability', [TableController::class, 'availability'])->name('table.availability');
});
