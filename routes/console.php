<?php

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('idea', function () {
    $this->call('ide-helper:models', [
        '-M' => true,
        '-r' => true,
        '-p' => true,
    ]);

    $this->call('ide-helper:meta');
    $this->call('ide-helper:eloquent');
    $this->call('ide-helper:generate');
})->purpose('Generate IDE helper files for models');
