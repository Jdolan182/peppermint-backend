<?php

namespace App\Http\Requests\Consumer;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ConsumerEditDetailsRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('consumers')->ignore($this->id)
            ],
        ];
    }
}
 