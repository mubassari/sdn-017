<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SekolahSettingsRequest extends FormRequest
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
            'nama'    => 'required|string|max:25',
            'logo'    => 'sometimes|nullable',
            'ikon'    => 'sometimes|nullable',
            'alamat'  => 'sometimes|nullable|string|max:225',
            'telepon' =>  [
                'sometimes',
                'nullable',
                'numeric',
                'starts_with:08,62',
                'regex:/^(62|08)[0-9]{9,13}$/'
             ],
            'email'   => 'sometimes|nullable|string|email|max:225'
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->sometimes('logo', ['image', 'mimes:jpeg,png,jpg', 'max:1024'], function ($input) {
            // Check if the 'logo' input is not empty and is an instance of UploadedFile
            return !empty($input->logo) && $input->logo instanceof \Illuminate\Http\UploadedFile;
        });
        $validator->sometimes('ikon', ['image', 'mimes:jpeg,png,jpg', 'max:1024', 'dimensions:max_width=100,max_height=100'], function ($input) {
            // Check if the 'ikon' input is not empty and is an instance of UploadedFile
            return !empty($input->ikon) && $input->ikon instanceof \Illuminate\Http\UploadedFile;
        });
        $validator->after(function ($validator) {
            $validator->setData(
                collect($validator->getData())
                    ->filter(fn ($value) => $value)
                    ->all()
            );
        });

        session(['scroll_position' => 'umum']);
    }
}
