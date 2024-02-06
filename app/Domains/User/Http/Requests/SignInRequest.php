<?php

namespace App\Domains\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules() : array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];
    }
}
