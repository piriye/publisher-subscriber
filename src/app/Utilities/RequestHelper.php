<?php

namespace App\Utilities;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RequestHelper
{
    public static function post($url, $data = [], $headers = [])
    {
        try {
            $response = Http::withHeaders($headers)->post($url, $data);

            if ($response->status() == 200) {
                return $response->json();
            }
        } catch (Exception $exception) {
            $errorMessage = "Unable to post data to " . $url;
            Log::error($errorMessage . " - " . $exception->getMessage());

            throw new Exception($errorMessage, $exception->getCode());
        }

        return null;
    }
}
