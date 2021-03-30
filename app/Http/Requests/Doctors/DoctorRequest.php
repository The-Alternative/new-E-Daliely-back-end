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
//            'first_name'=> 'required|min:3|max:255|regex:/^([a-zA-Z]+)/|unique:doctors,first_name',
//            'last_name'=> 'required|min:3|max:255|regex:/^([a-zA-Z]+)/|unique:doctors,last_name',
//            'description'=>'required|min:10|max:255:doctors',
//            'image'=>'required:doctors',

        ];

    }
    public function messages()
    {
        return [
//            'first_name.required' => 'Please Enter Your Doctor\'s First Name',
//            'first_name.min' => 'Your Doctor\'s First Name Is Too Short',
//            'first_name.max' => 'Your Doctor\'s First Name Is Too Long',
//            'first_name.regex' => 'Your Doctor\'s First Name Have Number',
//            'last_name.required' => 'Please Enter Your Doctor\'s  Last Name',
//            'last_name.min' => 'Your Doctor\'s Last Name Is Too Short',
//            'last_name.max' => 'Your Doctor\'s Last Name Is Too Long',
//            'last_name.regex' => 'Your Doctor\'s Last Name Have Number',
//            'description.required' => 'Please Enter Your Doctor\'s Description',
//            'Description.min' => 'Your Doctor Description\'s Is Too Short',
//            'description.max' => 'Your Doctor Description\'s Is Too Long',
//            'image.required' => 'Please Enter Your Doctor\'s Image',
        ];
    }
}
