<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminsResource extends JsonResource
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
            'type' => 'Admins',
            'attributes' =>[
                'name' => $this->name,
                'email' => $this->email,
                'photo' => $this->photo,
                'phone' => $this->phone,
                'status' => $this->status,
                'brand' => $this->brand,
                'category' => $this->category,
                'product' => $this->product,
                'orders' => $this->orders,
                'newsletter' => $this->newsletter,
                'setting' => $this->setting,
                'created_at' => $this->created_at->diffForHumans(),
                'updated_at' => $this->updated_at,
            ]   
        ];
    }
}
