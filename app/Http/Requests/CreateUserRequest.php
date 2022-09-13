<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'min:3', 'max:100', 'string'],
            'last_name' => ['required', 'min:3', 'max:100', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => [
                'required', 
                Password::min(8)->
                    letters()->
                    mixedCase()->
                    numbers()->
                    symbols()
            ],
            'age' => ['required', 'numeric', 'between:14, 100'],
        ];
    }
}
