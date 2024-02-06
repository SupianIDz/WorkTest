<?php

namespace App\Domains\User\Models;

use App\Domains\User\Models\IdeHelperAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @mixin IdeHelperAccessToken
 */
class AccessToken extends PersonalAccessToken
{
    //
}
