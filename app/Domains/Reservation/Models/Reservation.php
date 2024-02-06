<?php

namespace App\Domains\Reservation\Models;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperReservation
 */
class Reservation extends Model
{
    use HasUlids, HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code', 'table_id', 'start_at', 'end_at', 'seat', 'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
