<?php

namespace App\Http\Requests\Doctors;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name'=> 'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:brands,name',
            'description'=>'required|min:20|max:255:brands',
            'image'=>'required:brands',

        ];

    }
    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Doctor\'s First Name and Last Name',
            'name.min' => 'Your Doctor\'s Name Is Too Short',
            'name.max' => 'Your Doctor\'s Name Is Too Long',
            'name.regex' => 'Your Doctor\'s Name Have Number',
            'description.required' => 'Please Enter Your Doctor\'s Description',
            'Description.min' => 'Your Doctor Description\'s Is Too Short',
            'description.max' => 'Your Doctor Description\'s Is Too Long',
            'image.required' => 'Please Enter Your Doctor\'s Image',
        ];
    }
}
