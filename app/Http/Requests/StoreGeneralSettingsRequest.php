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
            'day_of_week' => 'array',
            'day_of_week.*' => 'numeric|between:0,6',
            'time_open' => 'array',
            'time_open.*' => 'numeric|between:1,24',
            'work_duration' => 'array',
            'work_duration.*' => 'numeric|between:1,24',
            'social_id' => 'array',
            'social_id.*' => 'numeric',
            'share_link' => 'array',
            'share_link.*' => 'url|max:150',
            'page_link' => 'array',
            'page_link.*' => 'url|max:150'
        ];
    }
}
