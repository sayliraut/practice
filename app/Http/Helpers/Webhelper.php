
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

if (!function_exists('saveSingleImageWithoutCrop')) {
    function saveSingleImageWithoutCrop($image, $path, $image_db = null)
    {
        $thumbnail = '';

        if (!empty($image)) {
            // Define the folder path where the image will be stored
            $folderPath = storage_path('app/public/uploads/' . $path . '/');

            // Generate a unique image name
            $imageName = uniqid() . '.png';

            // Move the uploaded image to the specified folder
            $image->move($folderPath, $imageName);

            // If there was a previous image, delete it
            if (!empty($image_db)) {
                $previousImagePath = $folderPath . $image_db;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $thumbnail = $imageName;
        } elseif (!empty($image_db)) {
            $thumbnail = $image_db;
        }

        return $thumbnail;
    }
}