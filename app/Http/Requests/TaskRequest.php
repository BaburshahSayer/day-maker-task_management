<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'task_title'=>'required',
            'priority'=>'required',
            'project_id'=>'required',
        ];
    }
    public function messages()
    {
    return [
        'task_title.required' => 'Task is required',
        'priority.required' => 'Priority is required',
        'project_id.required' => 'Project is required',
    ];
}
}
