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
            'email' =>
                'required|email|max:255|unique:organisations,email,' .
                request()->id,
            'phone' => 'required|max:20',
            'address' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|numeric',
            'logo' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }
}
