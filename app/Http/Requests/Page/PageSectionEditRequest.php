<?php

namespace App\Http\Requests\Page;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageSectionEditRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        
        $this->merge([
            'data' => json_encode($this->data)
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order' => [
                'required',
                'numeric',
            ],
            'data' => [
                'required',
                'string',
            ],
        ];
    }
}
 