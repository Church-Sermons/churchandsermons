<?php

namespace App\Http\Requests;

use App\Traits\ResourceTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreSermonRequest extends FormRequest
{
    use ResourceTrait;
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
        $response = $this->getTag(request());

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|numeric',
            'speakers' => 'required|array|min:1',
            'speakers.*' => 'required|numeric|exists:profiles,id'
        ];

        $rules = array_merge($rules, $response['rules']);

        return $rules;
    }
}
