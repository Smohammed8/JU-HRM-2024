<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExternalExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'

            'employee_id' =>'required',
            'unit_id'=>'required',
            'job_title'=> 'required|regex:/^[a-z A-Z]+$/u|min:5|max:30',
            'company_name' =>'required|regex:/^[a-z A-Z]+$/u|min:5|max:30',
            'start_date'=> 'required|date',
            'end_date'=>'required|date',
            'comment' => 'nullable|regex:/^[a-z A-Z]+$/u|min:20|max:255',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
