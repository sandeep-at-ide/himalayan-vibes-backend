<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFound()
    {
        return response()->json([
            'error' => 'Not Found',
            'message' => 'The requested resource was not found.'
        ], 404);
    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Unauthorized',
            'message' => 'You are not authorized to access this resource.'
        ], 401);
    }

    public function forbidden()
    {
        return response()->json([
            'error' => 'Forbidden',
            'message' => 'You do not have permission to access this resource.'
        ], 403);
    }

    public function badRequest()
    {
        return response()->json([
            'error' => 'Bad Request',
            'message' => 'The request could not be understood or was missing required parameters.'
        ], 400);
    }

    public function internalServerError()
    {
        return response()->json([
            'error' => 'Internal Server Error',
            'message' => 'An unexpected error occurred on the server.'
        ], 500);
    }

    public function methodNotAllowed()
    {
        return response()->json([
            'error' => 'Method Not Allowed',
            'message' => 'The HTTP method is not allowed for this endpoint.'
        ], 405);
    }

    public function conflict()
    {
        return response()->json([
            'error' => 'Conflict',
            'message' => 'A conflict occurred with the current state of the resource.'
        ], 409);
    }

    public function unprocessableEntity()
    {
        return response()->json([
            'error' => 'Unprocessable Entity',
            'message' => 'The request was well-formed but was unable to be followed due to semantic errors.'
        ], 422);
    }

    public function tooManyRequests()
    {
        return response()->json([
            'error' => 'Too Many Requests',
            'message' => 'You have sent too many requests in a given amount of time.'
        ], 429);
    }

    public function serviceUnavailable()
    {
        return response()->json([
            'error' => 'Service Unavailable',
            'message' => 'The server is currently unable to handle the request due to maintenance or overload.'
        ], 503);
    }
}
