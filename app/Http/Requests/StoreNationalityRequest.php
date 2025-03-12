<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNationalityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100|unique:nationalities,name',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الجنسية مطلوب',
            'name.unique' => 'اسم الجنسية مسجل مسبقا',
            'name.max' => 'اسم الجنسية يجب ان لا يزيد عن 100 حرف',
            'status.required' => ' حالة الجنسية مطلوبة',
            'status.in' => ' حالة الجنسية غير صحيحة',
        ];
    }

}
