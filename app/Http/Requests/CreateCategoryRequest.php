<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'master_category_id' => 'nullable|bail|integer|exists:category,id',
            'category_name' => 'required|max:50|unique:category,category_name',
            'category_img' => 'max:50'
        ];
    }
}
