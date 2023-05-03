<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'title'       => 'required|min:2|max:255',
            'tags'        => 'required|min:2|max:255',
            'about'       => 'max:255',
            'website'     => 'max:255',
            'keywords'    => 'max:255',
            'description' => 'max:255',
            'status'      => 'max:255',
            'order'       => 'max:1024',
            'image.*'     => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
