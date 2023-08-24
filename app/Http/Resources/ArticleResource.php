<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public $with = [
        'author' => 1,
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (isset(request()->with['author'])) {
            $this->with['author'] = (int) request()->with['author'];
        }
        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
            'image' => $this->image,
            'video' => $this->video,
            'content' => $this->content,
        ];
            if($this->with['author']){
                ($data['author'] = $this->author_id);
            }
        return $data;
    }
}
