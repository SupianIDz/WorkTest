<?php

namespace App\Domains\Table\Observers;

use App\Domains\Table\Models\Table;

class TableObserver
{
    /**
     * @param  Table $table
     * @return void
     */
    public function creating(Table $table) : void
    {
        if (! $table->code) {
            $table->code = strtoupper(str()->random(4));
        }
    }
}
