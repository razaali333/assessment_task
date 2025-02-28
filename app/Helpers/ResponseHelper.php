<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $message = "Success", $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Error response
     *
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message, $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
