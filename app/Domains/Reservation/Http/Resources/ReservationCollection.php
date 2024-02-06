<?php

namespace App\Domains\Reservation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Laravel\Domains\Reservation\Models\Reservation */
class ReservationCollection extends ResourceCollection
{
    public function toArray(Request $request) : array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
