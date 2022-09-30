<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCandidateRequest extends FormRequest
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
            'experience' => ['required', 'integer', 'min:0', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'city' => ['string', 'max:100', 'nullable'],
            'portfolio' => ['url', 'nullable'],
            'text' => ['string', 'max:2000', 'nullable'],
            'photo' => ['image', 'nullable'],
        ];
    }
}
