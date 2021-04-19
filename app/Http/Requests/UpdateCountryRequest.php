<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
                'min:2',
                'max:100',
                Rule::unique('countries', 'name')->ignoreModel($this->route('country'))
            ],

            'capital' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique('countries', 'capital')->ignoreModel($this->route('country'))
            ],
        ];
    }
}
