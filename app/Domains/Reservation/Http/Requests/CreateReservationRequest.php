<?php

namespace App\Domains\Reservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'seat'            => [
                'required',
            ],
            'start_at'        => [
                'required',
            ],
            'end_at'          => [
                'nullable',
            ],
        ];
    }

    public function authorize() : bool
    {
        return true;
    }
}
