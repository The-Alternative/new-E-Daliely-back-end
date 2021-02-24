<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Products\Product;

class ProductRequest extends FormRequest
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
            'title' => 'required|min:3|max:50|unique:products',
            'slug' => 'required|min:3|max:50:products',
            'brand_id' => 'required:products',
            'barcode' => 'required|unique:products',
            'short_des' => 'required|min:5|max:250:products',
            'meta' => 'required|min:3|max:50:products',
            'description' => 'required|min:5|max:500:products',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Please Enter Your Product\'s Title',
            'title.min'=>'Your Product\'s Title Is Too Short',
            'title.max'=>'Your Product\'s Title Is Too Long',
            'title.unique'=>'This Title\'s Is Used By Another Product',
            'slug.required'=>'Please Enter Your Product\'s Slug',
            'slug.min'=>'Your Product\'s Slug Is Too Short ',
            'slug.max'=>'Your Product\'s Slug Is Too Long',
            'brand_id.required'=>'Please Secify The Brand',
            'barcode.required'=>'Please Enter Your Product\'s Barcode',
            'barcode.unique'=>'This Barcode\'s Is Used By Another Product',
            'short_des.required'=>'Please..Enter Your Product\'s Short Description',
            'meta.required'=>'Please Enter Your Product\'s Meta',
            'meta.min'=>'Your Product\'s Meta Is Too Short',
            'meta.max'=>'Your Product\'s Meta Is Too Long',
            'description.required'=>'Please Enter Your Product\'s Description',
            'Description.min'=>'Your Product Description\'s Is Too Short',
            'description.max'=>'Your Product Description\'s Is Too Long',
        ];
    }
}
