<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkScheduleRequest extends FormRequest
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
            'day_of_week.*' => 'required_if:open_hours,2|numeric|between:0,6',
            'time_open' => 'array',
            'time_open.*' => 'required_if:open_hours,2|numeric|between:1,24',
            'work_duration' => 'array',
            'work_duration.*' =>
                'required_if:open_hours,2|numeric|between:1,24',
            'o_work_duration' =>
                'required_if:open_hours,1|numeric|between:1,24',
            'o_time_open' => 'required_if:open_hours,1|numeric|between:1,24'
        ];
    }
}
