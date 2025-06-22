<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($data = [], $message = 'Success', $statusCode = 200, $pagination = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $statusCode);
    }

    public static function error($message = 'Something went wrong', $errors = [], $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }
}
