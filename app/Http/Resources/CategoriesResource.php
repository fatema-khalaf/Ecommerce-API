<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
            'type' => 'Categories',
            'attributes' =>[
                'category_name_en' => $this->category_name_en,
                'category_name_ar' => $this->category_name_ar,
                'category_slug_en' => $this->category_slug_en,
                'category_slug_ar' => $this->category_slug_ar,
                'category_icon' => $this->category_icon,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'subcategries' => SubcategoriesResource::collection($this->whenLoaded('subcategories')),
                'subsubcategries' => SubsubcategoriesResource::collection($this->whenLoaded('subsubcategories')),
            ],
            // "relationships" => [
            //     "subcategories" => [
            //       "links" => [
            //         "self" => "/api/v1/categories/relationships/subcategories",
            //       ],
            //       'subcategries' => SubcategoriesResource::collection($this->whenLoaded('subcategories')),
            //       ]
            // ],  
        ];
    }

}
