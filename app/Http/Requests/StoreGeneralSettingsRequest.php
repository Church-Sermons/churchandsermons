<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralSettingsRequest extends FormRequest
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
            'social_id.*' => 'numeric',
            'share_link' => 'array',
            'share_link.*' => 'url|max:150',
            'page_link' => 'array',
            'page_link.*' => 'url|max:150'
        ];
    }
}
