<?php

namespace App\Http\Controllers\Api;

use App\DTO\UploadMediaDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Services\ServicesService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends Controller
{
    /**
     * @param ServicesService $servicesService
     */
    public function __construct(protected ServicesService $servicesService)
    {
    }

    /**
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function uploadImage(UploadRequest $request)
    {
        $validatedData = $request->validated();
        $uploadMediaDTO = new UploadMediaDTO($validatedData);
        $uploadedPaths = $this->servicesService->upload($uploadMediaDTO);
        return response()->json([
            'image' => 'storage/'.$uploadedPaths->imagePath,
            'video' => 'storage/'.$uploadedPaths->videoPath
        ], Response::HTTP_CREATED);
    }
}
