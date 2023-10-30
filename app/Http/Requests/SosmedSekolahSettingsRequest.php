<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SosmedSekolahSettingsRequest extends FormRequest
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
            'facebook'  => 'sometimes|nullable|string|starts_with:facebook.com',
            'instagram' => 'sometimes|nullable|string|starts_with:instagram.com',
            'tiktok'    => 'sometimes|nullable|string|starts_with:tiktok.com',
            'twitter'   => 'sometimes|nullable|string|starts_with:twitter.com,x.com',
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

        session(['scroll_position' => 'sosmed']);
    }
}
