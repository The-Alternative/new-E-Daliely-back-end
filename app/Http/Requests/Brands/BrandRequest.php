<?php

namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
<<<<<<< HEAD
        return true;
=======
        return false;
>>>>>>> 147a9d6640b5efa2eaa525babaaf6aeb77fce6d1
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'require|min:5|max:255|unique:brands,name',
            'slug'=>'required',
            'description'=>'required|min:20|max:255',
            'image'=>'required',
            'is_active'=>'required',

        ];
    }
}