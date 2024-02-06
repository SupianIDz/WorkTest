<?php

namespace App\Domains\Reservation\Entities;

use App\Domains\Reservation\Http\Requests\CreateReservationRequest;
use App\Support\Entity;

/**
 * @method int getSeat()
 * @method string getEndAt()
 * @method string getStartAt()
 * @method self setSeat(int $seat)
 * @method self setEndAt(string $end_at)
 * @method self setStartAt(string $start_at)
 */
class CreateReservationEntity extends Entity
{
    /**
     * @param  CreateReservationRequest $request
     * @return self
     */
    public function fromRequest(CreateReservationRequest $request) : self
    {
        return
            $this
                ->setSeat($request->get('seat'))
                ->setEndAt($request->get('end_at'))
                ->setStartAt($request->get('start_at'));
    }
}
