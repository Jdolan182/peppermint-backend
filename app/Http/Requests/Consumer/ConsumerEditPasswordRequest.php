<?php

namespace App\Http\Requests\Consumer;

use App\Models\Industry;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ConsumerEditPasswordRequest extends FormRequest
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
            'current_password' => [
                'required', 
                'current_password'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8'
            ]
        ];
    }
}
 