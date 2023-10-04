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
            'judul'   => 'required|string',
            'isi'     => 'required|string|max:65535',
            'sampul'  => 'sometimes|nullable',
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
        $validator->sometimes('sampul', ['image', 'mimes:jpeg,png,jpg', 'max:1024'], function ($input) {
            // Check if the 'sampul' input is not empty and is an instance of UploadedFile
            return !empty($input->sampul) && $input->sampul instanceof \Illuminate\Http\UploadedFile;
        });
        $validator->after(function ($validator) {
            if (in_array($this->isi, ["", "<br>", "<p><br></p>"])) {
                $validator->errors()->add('isi', 'Isian ini wajib diisi');
            }
        });
    }
}
