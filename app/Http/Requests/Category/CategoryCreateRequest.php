<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoryName' => 'nullable|string',
            'categoryName_bn'=> 'required|string',
            'categoryDetails' => 'nullable|string',
            'categoryDetails_bn' => 'required|string',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ];
    
    }
}
