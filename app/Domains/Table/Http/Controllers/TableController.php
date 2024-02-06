<?php

namespace App\Domains\Table\Http\Controllers;

use App\Domains\Table\Actions\FindAvailableSlotAction;
use App\Domains\Table\Http\Resources\TableCollection;
use App\Domains\Table\Models\Table;
use App\Domains\Table\Repositories\TableRepository;

class TableController
{
    /**
     * @return TableCollection
     */
    public function availability(TableRepository $repository)
    {
        return new TableCollection($repository->get(
            Table::STATUS_ACTIVE
        ));
    }
}
