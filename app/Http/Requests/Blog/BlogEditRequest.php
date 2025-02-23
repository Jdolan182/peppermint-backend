<?php

namespace App\Http\Requests\Blog;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
                Rule::unique('blogs')->ignore($this->id)

            ],
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs')->ignore($this->id)
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
 