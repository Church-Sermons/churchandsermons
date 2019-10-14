<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social_id' => 'array',
            'social_id.*' => 'required|alpha_dash',
            'share_link' => 'array',
            'share_link.*' => 'nullable|url|max:150',
            'page_link' => 'array',
            'page_link.*' => 'nullable|url|max:150'
        ];
    }
}
