<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Models\AccessToken;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        Sanctum::usePersonalAccessTokenModel(AccessToken::class);
        $this->loadRoutesFrom(
            __DIR__ . '/../api.php'
        );
    }
}
