<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'Xsection' => 'required|exists:sections,id',
            'Xcategory' => 'required|exists:categories,id',
            'food' => 'required|exists:foodlists,id',
            'type' => 'required|exists:quantity_types,id',
            'description' => 'required|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'Xsection.required' => 'القسم مطلوب',
            'Xsection.exists' => 'القسم غير صحيح',
            'Xcategory.required' => 'الفئة مطلوبة',
            'Xcategory.exists' => 'الفئة غير صحيحة',
            'food.required' => 'الطبخة مطلوبة',
            'food.exists' => 'الطبخة غير صحيحة',
            'type.required' => 'الكمية مطلوبة',
            'type.exists' => 'الكمية غير صحيحة',
            'description.required' => 'وصف الصنف مطلوب',
            'description.max' => 'وصف الصنف يجب ان لا يزيد عن 255 حرف',
            'price.required' => 'السعر مطلوب',
            'price.regex' => 'السعر غير صحيح',
            'status.required' => 'حالة الصنف مطلوبة',
            'status.in' => ' حالة الصنف غير صحيحة',
        ];
    }
}
