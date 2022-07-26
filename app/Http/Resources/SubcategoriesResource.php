<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoriesResource extends JsonResource
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
            'type' => 'Subcategories',
            'attributes' =>[
                'subcategory_name_en' => $this->subcategory_name_en,
                'subcategory_name_ar' => $this->subcategory_name_ar,
                'subcategory_slug_en' => $this->subcategory_slug_en,
                'subcategory_slug_ar' => $this->subcategory_slug_ar,
                'category_id' => $this->category_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                //whenLoaded means if it is reqested with category show category else show nothing
                'category' => new CategoriesResource($this->whenLoaded('category')), // when the relation is belongs to 
                'subsubcategries' => SubsubcategoriesResource::collection($this->whenLoaded('subsubcategories')), // when the relation is has many
            ]   
        ];    
    }
}
