<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengaturanArtikelSettingsRequest extends FormRequest
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
            'max_artikel_terbaru'   => 'required|numeric|in:2,3,4,5,6,7,8,9',
            'max_artikel_terkait'   => 'required|numeric|in:2,4,6',
            'max_artikel_kategori'  => 'required|numeric|in:8,12,16',
            'max_artikel_pencarian' => 'required|numeric|in:8,12,16',
        ];
    }
}
