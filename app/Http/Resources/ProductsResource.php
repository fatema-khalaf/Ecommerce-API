<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'products',
            'attributes' =>[
                'brand_id' =>  $this->brand_id,
                'category_id' => (string)$this->category_id,
                'subcategory_id' => (string)$this->subcategory_id,
                'subsubcategory_id' => $this->subsubcategory_id,
                'product_name_en' => $this->product_name_en,
                'product_name_ar' => $this->product_name_ar,
                'product_slug_en' => $this->product_slug_en,
                'product_slug_ar' => $this->product_slug_ar,
                'product_code'  => $this->product_code,
                'product_qty' => $this->product_qty,
                'product_tags_en' => $this->product_tags_en,
                'product_tags_ar' => $this->product_tags_ar,
                'product_size_en' => $this->product_size_en,
                'product_size_ar' => $this->product_size_ar,
                'product_color_en' => $this->product_color_en,
                'product_color_ar' => $this->product_color_ar,
                'selling_price' => $this->selling_price,
                'discount' => $this->discount,
                'short_descp_en' => $this->short_descp_en,
                'short_descp_ar'  => $this->short_descp_ar,
                'long_descp_en'  => $this->long_descp_en,
                'long_descp_ar'  => $this->long_descp_ar,
                'product_thambnail'  => $this->product_thambnail,
                'product_images' => ProductImagesResource::collection($this->whenLoaded('images')), 
                'brand_name_en' => $this->brand_name_en, 
                'subsubcategory_name_en' => $this->subsubcategory_name_en, 
                'hot_deals' => $this->hot_deals,
                'featured' => $this->featured,
                'special_offer' => $this->special_offer,
                'special_deals' => $this->special_deals,
                'status' => (string)$this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]   
        ];  
    }
}
