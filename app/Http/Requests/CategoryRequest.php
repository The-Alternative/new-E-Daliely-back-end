<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Categories\Category;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name'          => $request->name,
                'slug'          => $request->slug,
                'is_active'     => $is_active,
                'parent_id'     => (int)$request->parent,
                'image'         => $request->image->store('images','public')
        ];
    }
}
