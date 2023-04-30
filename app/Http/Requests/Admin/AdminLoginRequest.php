<?php

namespace App\Http\Requests\Admin;

use App\Models\Industry;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return auth()->check();
    // }

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
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }
}
 