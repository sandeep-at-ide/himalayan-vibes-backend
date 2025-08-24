<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ErrorController extends Controller
{
    public function notFound($message = "Resource not found"): JsonResponse
    {
        return response()->json([
            'error' => $message
        ], 404);
    }

    public function badRequest($message = "Bad request"): JsonResponse
    {
        return response()->json([
            'error' => $message
        ], 400);
    }

    public function unauthorized($message = "Unauthorized"): JsonResponse
    {
        return response()->json([
            'error' => $message
        ], 401);
    }

    public function forbidden($message = "Forbidden"): JsonResponse
    {
        return response()->json([
            'error' => $message
        ], 403);
    }

    public function internalError($message = "Internal server error"): JsonResponse
    {
        return response()->json([
            'error' => $message
        ], 500);
    }
}
