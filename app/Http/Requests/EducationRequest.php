<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "university"     => "required|max:255",
            "faculty"        => "required|max:255",
            "education_date" => "required",
            "education_type" => "max:255",
            "description"    => "max:1000",
            "order"          => "max:1000",
            "status"         => "max:255",
        ];
    }
}
