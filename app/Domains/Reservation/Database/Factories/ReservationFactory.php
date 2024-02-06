<?php

namespace App\Domains\Reservation\Database\Factories;

use App\Domains\Reservation\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * @return array
     */
    public function definition() : array
    {
        $day = rand(1, 1 );

        return [
            'code'     => strtoupper(str()->random(6)),
            'start_at' => now()->addDays($day)->format('Y-m-d H:00:00'),
            'end_at'   => now()->addDays($day)->addHours(rand(1, 3))->format('Y-m-d H:00:00'),
            'seat'     => rand(1, 10),
        ];
    }
}
