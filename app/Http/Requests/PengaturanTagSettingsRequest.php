<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PengaturanTagSettingsRequest extends FormRequest
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
            'header'   => 'nullable|string',
            'footer'   => 'nullable|string',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        session(['scroll_position' => 'tag']);
    }
}
