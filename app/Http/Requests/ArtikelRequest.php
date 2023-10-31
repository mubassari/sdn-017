<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelRequest extends FormRequest
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
            'judul'       => 'required|string',
            'isi'         => 'required|string',
            'artikel_kategori_id' => 'required|exists:kategori,id'
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
        $validator->after(function ($validator) {
            if (in_array($this->isi, ["", "<br>", "<p><br></p>"])) {
                $validator->errors()->add('isi', 'Isian ini wajib diisi');
            }
        });
    }
}
