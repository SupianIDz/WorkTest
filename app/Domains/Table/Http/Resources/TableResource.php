<?php

namespace App\Domains\Table\Http\Resources;

use App\Domains\Table\Actions\FindAvailableSlotAction;
use App\Domains\Table\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Table */
class TableResource extends JsonResource
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray(Request $request) : array
    {
        return [
            'code'     => $this->code,
            'capacity' => $this->capacity,
            'status'   => $this->status,
            'slots'    => $this->when($request->filled('date'), function () use ($request) {
                return (new FindAvailableSlotAction($this->resource))->handle($request->get('date'));
            }),
        ];
    }
}
