<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'en_name' => ['required', 'string', 'max:250'],
            'ar_name' => ['nullable', 'string', 'max:250'],
            'en_job' => ['nullable', 'string', 'max:250'],
            'ar_job' => ['nullable', 'string', 'max:250'],
            'en_description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'library_image' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
