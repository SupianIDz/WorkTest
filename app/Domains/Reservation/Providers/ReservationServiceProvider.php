<?php

namespace App\Domains\Reservation\Providers;

use App\Domains\Reservation\Models\Reservation;
use App\Domains\Reservation\Observers\ReservationObserver;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->booting(function () {
            Reservation::observe(ReservationObserver::class);
        });

        $this->loadRoutesFrom(
            __DIR__ . '/../api.php'
        );
    }
}
