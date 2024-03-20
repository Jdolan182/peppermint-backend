<?php

namespace App\Http\Requests\Blog;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:blog'
            ],
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:blog'
            ],
            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],
            'content' => [
                'nullable',
                'string',
            ],
            'is_active' =>[ 
                'required',
            ],
            'live_date' =>[ 
                'nullable',
                'date',
            ]
        ];
    }
}
 