<?php

<<<<<<< HEAD
=======
<<<<<<< HEAD:app/Http/Requests/Location/LocationRequest.php
namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
<<<<<<< HEAD
=======
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f:app/Http/Requests/Brands/BrandRequest.php
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
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
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
<<<<<<< HEAD


            'name'=> 'required|min:5|max:255|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)+$/|unique:brands,name',
            'slug'=>'required:brands',
            'description'=>'required|min:20|max:255:brands',
            'image'=>'required:brands',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Brand\'s Name',
            'name.min' => 'Your Brand\'s Name Is Too Short',
            'name.max' => 'Your Brand\'s Name Is Too Long',
            'name.regex' => 'Your Brand\'s Name Have Number',
            'name.unique' => 'This Name\'s Is Used By Another Brand',
            'slug.required' => 'Please Enter Your Brand\'s Slug',
            'description.required' => 'Please Enter Your Brand\'s Description',
            'Description.min' => 'Your Brand Description\'s Is Too Short',
            'description.max' => 'Your Brand Description\'s Is Too Long',
            'image.required' => 'Please Enter Your Brand\'s Image',
        ];
    }


=======
<<<<<<< HEAD:app/Http/Requests/Location/LocationRequest.php
            //
=======
            'name'=> 'require|min:5|max:255|unique:brands,name',
            'slug'=>'required',
            'description'=>'required|min:20|max:255',
            'image'=>'required',
            'is_active'=>'required',

>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f:app/Http/Requests/Brands/BrandRequest.php
        ];
    }
>>>>>>> bddb17837c6643f5ec654d88e6b30e45f2cb5c7f
}
