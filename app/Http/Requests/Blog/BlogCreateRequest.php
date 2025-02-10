<?php

namespace App\Http\Requests\Blog;

use Carbon\Carbon;
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
            'image_filename' => [
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
                'numeric',
            ],
            'author_id' => [
                'required',
                'numeric',
            ],
            'is_active' =>[ 
                'nullable',
                'numeric',
            ],
            'live_date' =>[ 
                'nullable',
                'date',
            ]
        ];
    }
}
 