<?php

namespace App\Domains\User\Models;

use App\Domains\User\Models\IdeHelperUser;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use HasUlids, HasFactory, HasApiTokens;

}
