<?php

namespace App\Http\Resources;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferCollection extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        /** @var $this Offer */
        return [
            'id' => $this->id,
            'brand' => $this->product->brand->name,
            'category' => $this->product->category->name,
            'price' => $this->price,
            'images' => ImageCollection::collection($this->images),
        ];
    }
}
