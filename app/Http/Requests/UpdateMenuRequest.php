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
            'price' => 'required|between:1,8|regex:/^\d+(\.\d{1,2})?$/',
            'minQty' => 'required|max:10',
            'bforeOrder' => 'required|max:10',
            'timeEnd' => 'required|max:10',
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
            'price.between' => 'يجب أن يحتوي :السعر بين :2 و :8 رقم/ارقام',
            'status.required' => 'حالة الصنف مطلوبة',
            'status.in' => ' حالة الصنف غير صحيحة',
            'image.required' => 'صورة الصنف مطلوب',
            'image.image' => 'صورة الصنف يجب ان تكون من نوع صورة',
            'image.mimes' => 'صورة الصنف يجب ان تكون jpg,jpeg,png',
            'image.max' => 'صورة الصنف يجب ان لا تزيد عن 5 ميجا',
            'minQty.max' => 'اقل كمية للطلب يجب ان لا تزيد عن 10 ارقام',
            'minQty.required' => 'اقل كمية للطلب مطلوبة',
            'bforeOrder.max' => 'عدد الساعات قبل التنفيذ يجب ان لا تزيد عن 10 ارقام',
            'bforeOrder.required' => 'عدد الساعات قبل التنفيذ مطلوبة',
            'timeEnd.max' => 'وقت التنفيذ بالساعة يجب ان لا تزيد عن 10 ارقام',
            'timeEnd.required' => 'وقت التنفيذ بالساعة مطلوب',
        ];
    }
}
