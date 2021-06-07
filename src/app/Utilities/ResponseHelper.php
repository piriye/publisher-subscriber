<?php

namespace App\Utilities;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper extends Response
{
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    const LABEL_STATUS = 'status';
    const LABEL_DATA = 'data';
    const LABEL_MESSAGE = 'message';
    const LABEL_CODE = 'code';

    /**
     * Returns a success response
     *
     * @param array $data
     * @param int $httpStatus
     * @return JsonResponse
     */
    public static function success($data = [], $httpStatus = 200, $message = null, $includeDataWrapper = false)
    {
        $response = [];

        if ($includeDataWrapper) {
            $response[self::LABEL_DATA] = $data;
        } else {
            $response = $data;
        }

        if ($message != null) {
            $response[self::LABEL_MESSAGE] = $message;
        }

        return response()->json($response)->setStatusCode($httpStatus);
    }

    /**
     * Returns a error response
     *
     * @param string $code
     * @param string $message
     * @param int $http_status
     * @return JsonResponse
     */
    public static function error($code, $message, $http_status = 400)
    {
        return response()->json([
            self::LABEL_CODE => $code,
            self::LABEL_STATUS => self::STATUS_ERROR,
            self::LABEL_MESSAGE => $message
        ])->setStatusCode($http_status);
    }
}
