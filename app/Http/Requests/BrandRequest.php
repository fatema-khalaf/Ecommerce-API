<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_name_en' => 'required|unique:brands|max:255',
            'brand_name_ar' => 'required|unique:brands|max:255',
            'brand_image' => 'required',
        ];
    }
  
    //To add custom error message
    
    // public function messages()
    // {
    //     return [
    //         'brand_name_en.required' => 'custom message.',
    //     ];
    // }
}
