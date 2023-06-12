<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected function success($data = null)
    {
        $response = ['success' => true];
        if ($data !== null) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    protected function error($message, $status = 500)
    {
        if ($message instanceof \Exception) {
            $message = $message->getMessage();
        }

        $data = [
            'success' => false,
            'error' => [
                'message' => $message,
                'status' => $status
            ]
        ];

        return response()->json($data, $status);
    }
}
