<?php

namespace App\Domains\Table\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Laravel\Domains\Table\Models\Table */
class TableCollection extends ResourceCollection
{
    /**
     * @param  Request $request
     * @return array
     */
    public function toArray(Request $request) : array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
