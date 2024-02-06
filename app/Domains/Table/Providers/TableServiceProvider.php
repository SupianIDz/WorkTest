<?php

namespace App\Domains\Table\Providers;

use App\Domains\Table\Models\Table;
use App\Domains\Table\Observers\TableObserver;
use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->booting(function () {
            Table::observe(TableObserver::class);
        });

        $this->loadRoutesFrom(
            __DIR__ . '/../api.php'
        );
    }
}
