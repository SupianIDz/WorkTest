<?php

namespace App\Domains\Table\Repositories;

use App\Domains\Table\Models\Table;
use Illuminate\Support\Collection;

class TableRepository
{
    /**
     * @param  string|null $status
     * @return Collection
     */
    public function get(string|null $status = null) : \Illuminate\Support\Collection
    {
        $query = Table::query();

        $query->when(filled($status), function ($builder) use ($status) {
            $builder->where('status', strtoupper($status));
        });

        return $query->get();
    }

    /**
     * @param  int $seat
     * @return Collection<Table>
     */
    public function getTablesByCapacity(int $seat) : Collection
    {
        return Table::active()->where('capacity', '>=', $seat)->get();
    }

    /**
     * @param  string $start
     * @param  string $end
     * @param  int    $capacity
     * @return Table|null
     */
    public function getAvailableTable(string $start, string $end, int $capacity) : Table|null
    {
        // first, get an available table with the number of capacity that meet the requirements
        $tables = $this->getTablesByCapacity($capacity);

        // filter tables that are not available on the specified schedule
        $tables = $tables->filter(function (Table $table) use ($end, $start) {
            return 0 === $table->reservations->whereBetween('start_at', [$start, $end])->count();
        });

        $nearest = $tables->min(function ($seat) {
            return $seat->capacity;
        });

        // look for a table that is nearest to the requested seat, so there are no wasted chairs
        $tables = $tables->filter(function (Table $table) use ($nearest) {
            return $table->capacity === $nearest;
        });

        return $tables->first();
    }
}
