<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UserPasswordRequest extends FormRequest
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
            'password_lama' => 'required|current_password',
            'password' => 'required|confirmed|min:8|different:password_lama',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function withValidator(Validator $validator): void
    {
        session(['scroll_position' => 'password']);
    }
}
