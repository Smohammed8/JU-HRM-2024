<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobTitleRequest extends FormRequest
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
        // dd('sd');
        return [
            'name' => 'required|unique:job_titles,name,'.request()->id,
            'level_id'  => 'required',
            'work_experience'=>'required',
            'educational_level_id'=>'required',
            'position_type_id'  => 'required',
            'description' =>'nullable|regex:/^[a-z A-Z]+$/u|min:3|max:255',
            'job_title_category_id'  => 'required',
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
