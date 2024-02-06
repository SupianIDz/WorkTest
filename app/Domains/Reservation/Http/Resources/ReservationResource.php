<?php

namespace App\Domains\Reservation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Laravel\Domains\Reservation\Models\Reservation */
class ReservationResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        return [
            'start_at'        => $this->start_at,
            'restaurant_code' => $this->restaurant_code,
            'created_at'      => $this->created_at,
            'deleted_at'      => $this->deleted_at,
            'table_id'        => $this->table_id,
            'user_id'         => $this->user_id,
            'end_at'          => $this->end_at,
            'code'            => $this->code,
            'updated_at'      => $this->updated_at,
        ];
    }
}
