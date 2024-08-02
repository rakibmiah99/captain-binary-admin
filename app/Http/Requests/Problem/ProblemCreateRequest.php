<?php

namespace App\Http\Requests\Problem;

use Illuminate\Foundation\Http\FormRequest;

class ProblemCreateRequest extends FormRequest
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
            "title"=> "nullable|string",
            "title_bn"=> "required|string",
            "difficulty"=> "required|string",
            "point"=> "required|numeric",
            "tags" => "required|string",
            "category_id" => "required|numeric|exists:categories,id",
            "description_bn"=> "required|string",
            "description"=> "nullable|string",
            "reference_title" => "nullable|string",
            "reference_link" => "nullable|string",
            "code" => "required|string",
            "test_case" => "required|string",
            "instructions_bn" => "required|mimes:pdf|max:100000",
            "instructions" => "nullable|mimes:pdf|max:100000"
        ];
    }
}
