<?php


namespace App\Http\Controllers;
use OpenApi\Attributes as OA;



class BaseController extends Controller
{
    public function error(string $message, $code)
    {
        return response()->json([
            'status' => 'Failed',
            'message' => $message,
        ], $code);
    }

    public function success(string $message, $data, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
