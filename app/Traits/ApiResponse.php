<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $message = "Success", $code = "00")
    {
        return response()->json([
            'success' => true,
            'cod_error' => $code,
            'message_error' => $message,
            'data' => $data
        ]);
    }

    public function errorResponse($message, $code)
    {
        return response()->json([
            'success' => false,
            'cod_error' => $code,
            'message_error' => $message,
            'data' => null
        ]);
    }
}
