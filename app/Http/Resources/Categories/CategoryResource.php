<?php

namespace App\Http\Resources\Categories;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request,$home = false): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $this->image,
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
        ];
    }
}
