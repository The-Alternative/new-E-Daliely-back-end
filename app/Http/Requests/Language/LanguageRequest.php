<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
//            'name'                =>'require:languages',
//            'active'              =>'require:languages',
//            'iso_code'            =>'require:languages',
//            'lang_code '          =>'require:languages',
//            'locale'              =>'require:languages',
//            'date_format_lite'    =>'require:languages',
//            'date_format_full'    =>'require:languages',
//            'is_rtl'              =>'require:languages'
        ];
    }
}
