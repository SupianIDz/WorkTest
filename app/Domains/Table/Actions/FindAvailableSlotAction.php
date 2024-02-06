<?php

namespace App\Domains\Table\Actions;

use App\Domains\Table\Models\Table;
use App\Support\Contracts\Action;
use Illuminate\Support\Carbon;

class FindAvailableSlotAction implements Action
{
    /**
     * @param  Table $table
     */
    public function __construct(protected Table $table)
    {
        //
    }

    /**
     * @param  string $date
     * @return array
     */
    public function handle(string $date) : array
    {
        $openingAt = $date . ' ' . setting('opening');
        $closingAt = $date . ' ' . setting('closing');

        $currentDateTime = Carbon::parse($openingAt);

        $reservations = $this->table->reservations->whereBetween('start_at', [$openingAt, $closingAt]);

        $availabilityHours = [];

        while ($currentDateTime < Carbon::parse($closingAt)) {
            $hour = $currentDateTime->format('H:00');
            $availabilityHours[$hour] = true;
            $currentDateTime->addHour();
        }

        foreach ($reservations as $reservation) {
            $startOfReservation = Carbon::parse($reservation->start_at);
            $endOfReservation = Carbon::parse($reservation->end_at);

            $startHour = $startOfReservation->format('H:00');
            $endHour = $endOfReservation->format('H:00');

            while ($startHour < $endHour) {
                if (isset($availabilityHours[$startHour])) {
                    $availabilityHours[$startHour] = false;
                }

                $startHour = Carbon::parse($startHour)->addHour()->format('H:00');
            }
        }

        $availabilityRanges = [];
        foreach ($availabilityHours as $hour => $availability) {
            $nextHour = Carbon::parse($hour)->addHour()->format('H:00');
            $availabilityRanges["$hour - $nextHour"] = $availability;
        }

        return $availabilityRanges;
    }
}
