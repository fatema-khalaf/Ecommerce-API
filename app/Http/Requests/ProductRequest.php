<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required|max:255',
            'product_name_ar' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_qty'  => 'required|integer',
            'product_tags_en' => 'nullable|min:1',
            'product_tags_ar' => 'nullable|min:1',
            'product_size_en'  => 'nullable|min:1',
            'product_size_ar'  => 'nullable|min:1',
            'product_color_en'  => 'nullable|min:1',
            'product_color_ar'  => 'nullable|min:1',
            'selling_price' => 'required|integer',
            'discount'  => 'nullable|integer',
            'short_descp_en'  => 'nullable|min:1',
            'short_descp_ar'  => 'nullable|min:1',
            'long_descp_en'  => 'nullable|min:1',
            'long_descp_ar'  => 'nullable|min:1',
            'product_thambnail' =>  'required',
            'hot_deals' => 'min:1',
            'featured' => 'min:1',
            'special_offer' => 'min:1',
            'special_deals' => 'min:1',
        ];
    }
}
