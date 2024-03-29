<?php

namespace App\Http\Requests\Blog;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BlogEditRequest extends FormRequest
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
                'unique:blogs,id,'.$this->id
            ],
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:blogs,id,'.$this->id
            ],
            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'content' => [
                'nullable',
                'string',
            ],
            'category_id' => [
                'required',
                'string',
            ],
            'is_active' =>[ 
                'nullable',
            ],
            'live_date' =>[ 
                'nullable',
                'date',
            ]
        ];
    }
}
 