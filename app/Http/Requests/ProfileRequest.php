<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image'             => 'mimes:jpeg,jpg,png',
            'cv'                => 'mimes:pdf,doc,docx',
            'main_title'        => 'max:255',
            'about_text'        => 'max:1024',
            'btn_contact_text'  => 'max:255',
            'small_title_left'  => 'max:255',
            'small_title_right' => 'max:255',
            'full_name'         => 'max:255',
            'job_name'          => 'max:255',
            'website'           => 'max:255',
            'phone'             => 'max:255',
            'mail'              => 'max:255',
            'location'          => 'max:255',
        ];
    }
}
