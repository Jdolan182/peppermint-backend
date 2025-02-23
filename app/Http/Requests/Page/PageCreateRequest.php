<?php

namespace App\Http\Requests\Page;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PageCreateRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
            'show_footer' => $this->is_active ? 1 : 0,
            'is_active' => $this->is_active ? 1 : 0
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
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:pages'
            ],
            'show_footer' =>[ 
                'nullable',
                'numeric',
            ],
            'is_active' =>[ 
                'nullable',
                'numeric',
            ]
        ];
    }
}
 