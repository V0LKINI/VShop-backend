<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageCollection extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        /** @var $this Image */
        return [
            'id' => $this->id,
            'image' => url('/storage/' . $this->image),
            'sort' => $this->sort,
        ];
    }
}
