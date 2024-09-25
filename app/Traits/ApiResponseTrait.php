<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponseTrait
{
    /**
     * Return a successful response with a message and data.
     *
     * @param  string  $message
     * @param  mixed  $data
     * @param  int  $statusCode
     * @return \Illuminate\Http\Response
     */
    public function successResponse($message, $data, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return an error response with a message and errors.
     *
     * @param  string  $message
     * @param  array  $errors
     * @param  int  $statusCode
     * @return \Illuminate\Http\Response
     */
    public function errorResponse($message, $errors, $statusCode = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}