<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GTKRequest extends FormRequest
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
        $rules = [
            'nama'           => 'required|string',
            'nip'           => 'sometimes|nullable|numeric|max:99999999999999999',
            'jenis_kelamin' => 'required|in:laki_laki,perempuan',
            'foto'          => 'sometimes|nullable',
            'gtk_jabatan_id' => 'required|exists:gtk_jabatan,id'
        ];

        return $rules;
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('foto', ['image', 'mimes:jpeg,png,jpg', 'max:1024'], function ($input) {
            // Check if the 'foto' input is not empty and is an instance of UploadedFile
            return !empty($input->foto) && $input->foto instanceof \Illuminate\Http\UploadedFile;
        });
    }
}
