<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent' => new CategoryResource($this->whenLoaded('parent')), // Trả về danh mục cha nếu đã load
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'children' =>  CategoryResource::collection($this->whenLoaded('children')), // Trả về danh mục con nếu đã load
        ];
    }
}
