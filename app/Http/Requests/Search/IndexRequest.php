<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => [
                'sometimes',
                'string',
                'max:510',
            ],
            'sort' => [
                'sometimes',
            ],
        ];
    }
}
