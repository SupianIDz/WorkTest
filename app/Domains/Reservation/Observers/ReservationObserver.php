<?php

namespace App\Domains\Reservation\Observers;

use App\Domains\Reservation\Models\Reservation;

class ReservationObserver
{
    /**
     * @param  Reservation $reservation
     * @return void
     */
    public function creating(Reservation $reservation) : void
    {
        if (blank($reservation->code)) {
            $reservation->code = strtoupper(str()->random(6));
        }
    }
}
