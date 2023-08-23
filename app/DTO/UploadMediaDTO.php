<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class UploadMediaDTO
{
    public ?string $imagePath;
    public ?string $videoPath;
    public ?UploadedFile $image;
    public ?UploadedFile $video;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->imagePath = $data['imagePath'] ?? '';
        $this->videoPath = $data['videoPath'] ?? '';
        $this->image = $data['image'] ?? null;
        $this->video = $data['video'] ?? null;
    }
}
