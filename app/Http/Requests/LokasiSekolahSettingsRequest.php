<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LokasiSekolahSettingsRequest extends FormRequest
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
            'latitude'  => 'required|string',
            'longitude' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $validator->setData(
                collect($validator->getData())
                    ->filter(fn ($value) => $value)
                    ->all()
            );
        });

        session(['scroll_position' => 'lokasi']);
    }
}
