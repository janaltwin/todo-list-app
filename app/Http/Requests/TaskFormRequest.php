<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:200',
            'details'=>'nullable',
            'category'=>'required', 
            'owner'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Name field required!',
            'category.required'=>'Category field required!',
            'owner.required'=>'Owner field required!'
        ];
    }
}
