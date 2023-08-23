<?php

namespace App\Http\Responses;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse
{
    public static function make($error, $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'error' => $error,
            'msg' => 'please try again'
        ], $statusCode);
    }
}
