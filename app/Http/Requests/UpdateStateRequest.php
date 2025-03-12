<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
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
            'name' => [
                    Rule::unique('states','name')->ignore($this->id),
                ],
            'name' => 'required|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => 'المنطقة مطلوبة',
            'country_id.numeric' => 'المنطقة غير صحيحة',
            'country_id.exists' => 'المنطقة غير صحيحة',
            'name.required' => 'اسم المدينة مطلوب',
            'name.unique' => 'اسم المدينة مسجل مسبقا',
            'name.max' => 'اسم المدينة يجب ان لا يزيد عن 100 حرف',
            'status.required' => ' حالة المدينة مطلوبة',
            'status.in' => ' حالة المدينة غير صحيحة',
        ];
    }
    
}
