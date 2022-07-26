<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubsubcategoriesResource extends JsonResource
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
            'id' => (string)$this->id, // according to json api spacifications id must be a string
            'type' => 'Subsubcategories',
            'attributes' =>[
                'subsubcategory_name_en' => $this->subsubcategory_name_en,
                'subsubcategory_name_ar' => $this->subsubcategory_name_ar,
                'subsubcategory_slug_en' => $this->subsubcategory_slug_en,
                'subsubcategory_slug_ar' => $this->subsubcategory_slug_ar,
                'subcategory_id' => $this->subcategory_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'subcategory' => new SubcategoriesResource($this->whenLoaded('subcategory')), 
            ]   
        ];  
    }
}
