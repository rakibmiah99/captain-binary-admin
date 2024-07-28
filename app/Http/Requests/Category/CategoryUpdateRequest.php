<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $rule = [
            'name' => 'required|array',
            'name.*' => 'string',
            'details' => 'required|array',
            'details.*' => 'string',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ];
        foreach (config('settings.language') as $lang=>$config){
            $rule['name.'.$lang] = $config['required'] === true ? 'required' : 'nullable';
            $rule['details.'.$lang] = $config['required'] === true ? 'required' : 'nullable';
        }
        return $rule;
    }
}
