<?php

namespace App\Http\Requests;

use App\Enums\SupportedExtensionsEnum;
use Illuminate\Foundation\Http\FormRequest;

class UploadCountriesFileRequest extends FormRequest
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
            'countries' => [
                'required',
                'file'
            ]
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $extension = $this->file('countries')->getClientOriginalExtension();

        $validator->after(function ($validator) use($extension) {
            if (! $this->file('countries')->isValid()) {
                $validator->errors()->add(
                    'countries',
                    trans('validation.countries.invalid')
                );
            }

            if ($this->fileTypeIsNotSupported($extension)) {
                $validator->errors()
                    ->add(
                        'countries',
                        trans('validation.countries.extension', [
                            'type' => $extension,
                            'types' => join(', ', SupportedExtensionsEnum::list())
                        ])
                    );
            }
        });
    }

    private function fileTypeIsNotSupported(string $ext): bool
    {
        return ! in_array($ext, SupportedExtensionsEnum::list());
    }
}
