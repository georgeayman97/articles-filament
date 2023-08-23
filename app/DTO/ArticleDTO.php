<?php

namespace App\DTO;

class ArticleDTO
{
    public string $title;
    public ?string $slug;
    public string $content;
    public string $status;
    public ?string $image;
    public ?string $video;
    public int $author_id;
    public ?array $categories;
    public ?array $tags;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->status = $data['status'];
        $this->author_id = $data['author_id'];
        $this->slug = $data['slug'] ?? '';
        $this->image = $data['image'] ?? null;
        $this->video = $data['video'] ?? null;
        $this->categories = $data['categories'] ?? [];
        $this->tags = $data['tags'] ?? [];
    }
}
