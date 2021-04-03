<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer'=>'required|array',
            'customer.*'=>'required|min:5',
            'customer.*.first_name'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,first_name',
            'customer.*.last_name'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,last_name',
            'customer.*.address'=>'required|min:3|max:100|regex:/^([a-zA-Z]+)/|unique:customer_translations,address',



        ];
    }
}
