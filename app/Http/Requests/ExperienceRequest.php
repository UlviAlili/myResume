<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            "company"         => "required|max:255",
            "position"        => "required|max:255",
            "experience_date" => "required",
            "description"     => "max:1000",
            "order"           => "max:1000",
            "status"          => "max:255",
        ];
    }
}
