<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'poster' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'lat' => 'required_with:lon|numeric',
            'lon' => 'required_with:lat|numeric'
        ];
    }
}
