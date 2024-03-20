<?php

namespace App\Http\Requests\Consumer;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerLoginRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
       
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'exists:consumers,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'This email does not exist in our records',
        ];
    }
}
 