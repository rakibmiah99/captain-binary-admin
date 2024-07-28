<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialCreateRequest extends FormRequest
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
            'designation' => 'required|array',
            'designation.*' => 'string',
            'comments' => 'required|array',
            'comments.*' => 'string',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
        ];
        foreach (config('settings.language') as $lang=>$config){
            $rule['name.'.$lang] = $config['required'] === true ? 'required' : 'nullable';
            $rule['designation.'.$lang] = $config['required'] === true ? 'required' : 'nullable';
            $rule['comments.'.$lang] = $config['required'] === true ? 'required' : 'nullable';
        }
        return $rule;
    }
}
