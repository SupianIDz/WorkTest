<?php

namespace App\Domains\Table\Models;

use App\Domains\Reservation\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTable
 * @property array $slots
 */
class Table extends Model
{
    use HasUlids, HasFactory;

    const STATUS_ACTIVE = 'ACTIVE';

    const STATUS_INACTIVE = 'INACTIVE';

    protected $fillable = [
        'code', 'capacity', 'floor', 'status',
    ];

    /**
     * @param  Builder $builder
     * @return Builder
     */
    public function scopeActive(Builder $builder) : Builder
    {
        return $builder->where('status', self::STATUS_ACTIVE);
    }

    /**
     * @return HasMany
     */
    public function reservations() : HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
