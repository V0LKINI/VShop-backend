<?php

namespace App\Http\Resources;

use App\Http\Resources\ImageCollection;
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
            'images' => ImageCollection::collection($this->images),
        ];
    }
}
