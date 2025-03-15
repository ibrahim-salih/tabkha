<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCookerRequest extends FormRequest
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
            // 'phone' => 'required|max:15|unique:cookers,phone',
            'firstName' => 'required|string|max:60|unique:cookers,f_name',
            'lastName' => 'required|string|max:40',
            'username' => 'required|string|max:60|unique:cookers,username',
            'gender' => 'required|in:"Male","Female"',
            'phone' => 'required|min:11|max:13|regex:/^([0-9\s\-\+\(\)]*)$/|unique:cookers,phone',
            // 'pirthdate' => 'required|date',
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'address' => 'required|string|max:160',
            'email' => 'required|max:200|email|unique:cookers,email',
            'password' => 'min:6|required',
            'password_confirmation' => 'required_with:password_confirmation|same:password',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:5096',
            'image2' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:5096',
            'accept' => 'required|accepted',
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => ' الاسم مطلوب',
            'firstName.unique' => 'الاسم موجود سابقا',
            'firstName.max' => 'الاسم يجب ان لا يزيد عن 60 حرف',
            'lastName.required' => ' الاسم مطلوب',
            'lastName.max' => 'الاسم يجب ان لا يزيد عن 40 حرف',
            'email.required' => 'الايميل مطلوب',
            'email.unique' => 'الايميل موجود سابقا',
            'email.email' => 'الايميل غير صحيح',
            'email.max' => 'الايميل يجب ان لا يزيد عن 200 حرف',
            'username.required' => 'اسم المطبخ مطلوب',
            'username.unique' => 'اسم المطبخ موجود سابقا',
            'username.max' => 'اسم المطبخ يجب ان لا يزيد عن 60 حرف',
            'phone.required' => 'رقم الموبايل مطلوب',
            'phone.unique' => 'رقم الموبايل موجود سابقا',
            'phone.regex' => 'رقم الموبايل غير صحيح',
            'phone.max' => 'رقم الموبايل يجب ان لا يزيد عن 15 حرف',
            'pirthdate.required' => 'تاريخ الميلاد مطلوب',
            'pirthdate.date' => 'تاريخ الميلاد غير صحيح',
            'country.required' => 'المحافظة مطلوبة',
            'country.numeric' => 'المحافظة غير صحيحة',
            'country.exists' => 'المحافظة غير صحيحة',
            'state.required' => 'المدينة مطلوبة',
            'state.numeric' => 'المدينة غير صحيحة',
            'state.exists' => 'المدينة غير صحيحة',
            'address.required' => ' العنوان مطلوب',
            'address.max' => 'العنوان يجب ان لا يزيد عن 160 حرف',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب ان لا تقل عن 6 حرف',
            'password_confirmation.required' => 'تاكيد كلمة المرور مطلوب',
            // 'password_confirmation.min' => 'تاكيد كلمة المرور يجب ان لا تقل عن 6 حرف',
            'password_confirmation.same' => 'كلمة المرور غير متطابقة',
            'gender.required' => ' الجنس مطلوب',
            'gender.in' => ' الجنس غير صحيح',
            'image.required' => 'سيلفى البطاقة وش مطلوب',
            'image.image' => 'سيلفى البطاقة وش يجب ان تكون من نوع صورة',
            'image.mimes' => 'سيلفى البطاقة وش يجب ان تكون jpg,jpeg,png',
            'image.max' => 'سيلفى البطاقة وش يجب ان لا تزيد عن 5 ميجا',
            'image2.required' => 'سيلفى البطاقة ظهر مطلوب',
            'image2.image' => 'سيلفى البطاقة ظهر يجب ان تكون من نوع صورة',
            'image2.mimes' => 'سيلفى البطاقة ظهر يجب ان تكون jpg,jpeg,png',
            'image2.max' => 'سيلفى البطاقة ظهر يجب ان لا تزيد عن 5 ميجا',
            'accept.required' => 'يجب ان توافق على اتفاقية الاستخدام',
        ];
    }

}
