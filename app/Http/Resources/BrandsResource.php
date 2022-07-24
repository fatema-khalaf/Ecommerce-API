<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $this here refers to $request
        return [
            'id' => (string)$this->id, // according to json api spacifications id must be a string
            'type' => 'Brands',
            'attributes' =>[
                'brand_name_en' => $this->brand_name_en,
                'brand_name_ar' => $this->brand_name_ar,
                'brand_slug_en' => $this->brand_slug_en,
                'brand_slug_ar' => $this->brand_slug_ar,
                'brand_image' => $this->brand_image,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]   
        ];
    }
}
