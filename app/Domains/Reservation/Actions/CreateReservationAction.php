<?php

namespace App\Domains\Reservation\Actions;

use App\Domains\Reservation\Entities\CreateReservationEntity;
use App\Domains\Reservation\Exceptions\TableNotAvailableException;
use App\Domains\Reservation\Models\Reservation;
use App\Domains\Table\Repositories\TableRepository;
use App\Domains\User\Models\User;
use Exception;

class CreateReservationAction
{
    /**
     * @var TableRepository
     */
    protected readonly TableRepository $tableRepository;

    /**
     * ReservationService constructor.
     */
    public function __construct()
    {
        $this->tableRepository = new TableRepository;
    }

    /**
     * @param  CreateReservationEntity $entity
     * @param  User|null               $user
     * @return mixed
     * @throws Exception
     */
    public function handle(CreateReservationEntity $entity, User|null $user = null) : mixed
    {
        $table = $this->tableRepository->getAvailableTable($entity->getStartAt(), $entity->getEndAt(), $entity->getSeat());

        if (! $table) {
            throw new TableNotAvailableException;
        }

        return Reservation::create(array_merge($entity->toArray(), [
            'table_id' => $table->getKey(),
            'user_id'  => $user?->getKey(),
        ]));
    }
}
