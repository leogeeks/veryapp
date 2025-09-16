<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Return a standardized JSON success response.
     */
    protected function successResponse(mixed $data = null, string $message = 'OK', int $status = 200)
    {
        $payload = [
            'success' => true,
            'message' => $message,
        ];

        if ($data !== null) {
            $payload['data'] = $data;
        }

        return response()->json($payload, $status);
    }

    /**
     * Return a standardized JSON error response.
     */
    protected function errorResponse(string $message = 'Error', int $status = 400, array $errors = [] )
    {
        $payload = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $status);
    }
}
