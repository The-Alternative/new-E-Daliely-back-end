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
            'short_des' => 'required:products',
            'meta' => 'required|min:3|max:50:products',
            'description' => 'required|min:5|max:250:products',
        ];
    }
    public function message()
    {
        return [
            'title.required'=>'Please Enter Your Product Title',
            'title.min'=>'Your Product Title Is Too Short',
            'title.max'=>'Your Product Title Is Too Long',
            'title.unique'=>'This Title Is Used By Another Product',
            'slug.required'=>'Please Enter Your Product Slug',
            'slug.min'=>'Your Products Slug Is Too Short',
            'slug.max'=>'Your Products Slug Is Too Long',
            'brand_id.required'=>'Please Secify The Brand',
            'barcode.required'=>'Please..Enter Your Product Barcode',
            'barcode.unique'=>'This Barcode Is Used By Another Product',
            'short_des.required'=>'Please..Enter Your Product Short Description',
            'meta.required'=>'Please Enter Your Product Meta',
            'meta.min'=>'Your Product Meta Is Too Short',
            'meta.max'=>'Your Product Meta Is Too Long',
            'description.required'=>'Please Enter Your Product Description',
            'Description.min'=>'Your Product Description Is Too Short',
            'description.max'=>'Your Product Description Is Too Long',
        ];
    }
}
