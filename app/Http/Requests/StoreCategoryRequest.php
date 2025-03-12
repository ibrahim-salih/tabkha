<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|max:255|unique:categories,name',
            'section' => 'required|exists:sections,id',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'section.required' => 'القسم مطلوب',
            'section.numeric' => 'القسم غير صحيح',
            'section.exists' => 'القسم غير صحيح',
            'name.required' => 'اسم المدينة مطلوب',
            'name.unique' => 'اسم المدينة مسجل مسبقا',
            'name.max' => 'اسم المدينة يجب ان لا يزيد عن 100 حرف',
            'status.required' => ' حالة المدينة مطلوبة',
            'status.in' => ' حالة المدينة غير صحيحة',
        ];
    }

}
