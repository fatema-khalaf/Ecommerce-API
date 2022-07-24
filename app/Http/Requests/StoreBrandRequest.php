<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'brand_name_en' => 'required|max:255',
            'brand_name_ar' => 'required|max:255',
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
