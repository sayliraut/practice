
<?php

use App\Models;
use App\Models\IamPrincipal;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


if (!function_exists('jsonResponseWithErrorMessage')) {
    function jsonResponseWithErrorMessage($errorMessage)
    {
        $response = [
            'status' => 'error',
            'message' => $errorMessage,
        ];
        return response()->json($response);

        // Stop further execution (optional)
        exit();
    }


    
if (!function_exists('jsonResponseWithSuccessMessage')) {
    function jsonResponseWithSuccessMessage($message, $data = [])
    {
        $statusCode = 200;
        // Prepare the response array
        $response = [
            'status' => 'success',
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response, $statusCode);

        // Stop further execution (optional)
        exit();
    }
}
}