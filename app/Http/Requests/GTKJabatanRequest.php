<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GTKJabatanRequest extends FormRequest
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
            'nama' => 'required|string|unique:gtk_jabatan,nama',
            'slug' => 'string|unique:gtk_jabatan,slug',
        ];

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $disallowedWords = ['Kepala Sekolah', 'Plt Kepala Sekolah', 'Plh Kepala Sekolah'];

            if (in_array(Str::slug($this->input('nama')), array_map('Str::slug', $disallowedWords))) {
                $validator->errors()->add('nama', "Pilihan nilai tidak sesuai.");
            }
        });
    }
}
