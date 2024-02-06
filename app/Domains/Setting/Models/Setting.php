<?php

namespace App\Domains\Setting\Models;

use App\Domains\Setting\Models\IdeHelperSetting;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSetting
 */
class Setting extends Model
{
    use HasUlids;

    protected $dateFormat = 'U';

    /**
     * @var array
     */
    protected $fillable = [
        'key', 'val',
    ];


}
