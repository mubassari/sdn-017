<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'nama' => 'required|string|unique:kategori,nama',
            'slug' => 'string|unique:kategori,slug',
        ];

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $disallowedWords = ['Admin', 'Kategori', 'Galeri', 'Berita', 'Sambutan'];

            if (in_array(strtolower($this->input('nama')), array_map('strtolower', $disallowedWords))) {
                $validator->errors()->add('nama', "Pilihan nilai tidak sesuai.");
            }
        });
    }
}
