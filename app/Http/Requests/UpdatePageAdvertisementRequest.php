<?php

namespace App\Http\Requests;

use App\Models\PageAdvertisement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePageAdvertisementRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'is_active' => ['nullable', 'boolean'],
            'media_type' => ['required', Rule::in(PageAdvertisement::MEDIA_TYPES)],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'library_images' => ['nullable', 'array'],
            'library_images.*' => ['nullable', 'string'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['string'],
            'offer_id' => ['nullable', 'integer', 'exists:offers,id'],
            'link_url' => ['nullable', 'url', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'images.*.image' => 'Each file must be an image.',
            'images.*.max' => 'Each image must be 5 MB or smaller.',
            'link_url.url' => 'The custom link must be a full URL (https://…).',
        ];
    }
}
