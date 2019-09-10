<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganisationRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:organisations,email',
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'slides' => 'array',
            'slides.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'day_of_week' => 'array',
            'day_of_week.*' => 'numeric|between:0,6',
            'time_open' => 'array',
            'time_open.*' => 'numeric|between:1,24',
            'work_duration' => 'array',
            'work_duration.*' => 'numeric|between:1,24',
            'social_id' => 'required_with:share_link,page_link',
            'share_link' => 'required_with:social_id',
            'page_link' => 'required_with:social_id'
        ];
    }
}
