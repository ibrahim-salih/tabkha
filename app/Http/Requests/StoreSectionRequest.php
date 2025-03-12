<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'name' => 'required|max:255|unique:sections,name',
            // 'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'type' => 'required|in:news,articles',
            'status' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'name.max' => trans('validation.max'),
            'order_is.unique' => trans('validation.unique'),
            'order_is.required' => trans('validation.required'),
            'order_is.max' => trans('validation.max'),
            'order_is.numeric' => trans('validation.numeric'),
            'type.required' => trans('validation.required'),
            'type.in' => trans('validation.in'),
            'status.required' => trans('validation.required'),
            'status.in' => trans('validation.in'),
        ];
    }


}
