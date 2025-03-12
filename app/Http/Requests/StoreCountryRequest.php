<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
            'name' => 'required|max:100|unique:countries,name',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المنطقة مطلوب',
            'name.unique' => 'اسم المنطقة مسجل مسبقا',
            'name.max' => 'اسم المنطقة يجب ان لا يزيد عن 100 حرف',
            'status.required' => ' حالة المنطقة مطلوبة',
            'status.in' => ' حالة المنطقة غير صحيحة',
        ];
    }


}
