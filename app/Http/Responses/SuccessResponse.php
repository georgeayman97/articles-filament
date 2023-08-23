<?php
namespace App\Http\Responses;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponse
{
    public static function make($data, $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $statusCode);
    }
}
