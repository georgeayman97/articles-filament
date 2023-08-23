<?php

namespace App\Services;

use App\DTO\UploadMediaDTO;
use Illuminate\Support\Facades\Storage;

class ServicesService
{
    /**
     * @param UploadMediaDTO $uploadMediaDTO
     * @return UploadMediaDTO
     */
    public function upload(UploadMediaDTO $uploadMediaDTO): UploadMediaDTO
    {
        $uploadMediaDTO->imagePath = $uploadMediaDTO->image ? Storage::disk('public')->put(
            'images',
            $uploadMediaDTO->image
        ) : null;
        $uploadMediaDTO->videoPath = $uploadMediaDTO->video ? Storage::disk('public')->put(
            'videos',
            $uploadMediaDTO->video
        ) : null;

        return $uploadMediaDTO;
    }

}
