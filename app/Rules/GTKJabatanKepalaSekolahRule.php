<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\GTK;

class GTKJabatanKepalaSekolahRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return GTK::where('gtk_jabatan_id', 1)->where('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pilihan nilai tidak sesuai.';
    }
}
