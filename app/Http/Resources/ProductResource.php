<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name_product'=> $this->name_product,
            'images' => $this->images,
            'price' => $this->price,
            'sale' => $this->sale,
            'amount' => $this->amount,
            'short_description' => $this->short_description,
            'detail' => $this->detail,
            'view' => $this->view,
            'idCategory'=> $this->idCategory
        ];
    }
}
