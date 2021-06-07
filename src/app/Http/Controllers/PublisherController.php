<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Jobs\PublishToTopic;
use App\Utilities\ErrorCode;
use App\Utilities\ResponseHelper;

class PublisherController extends Controller
{
    public function __construct()
    {
    }

    public function publishToTopic(string $topic, Request $request)
    {
        try {
            $dataToPublish = $request->all();

            PublishToTopic::dispatch($topic, $dataToPublish);

            return ResponseHelper::success([], 200, 'Publishing to topic for subscribers');
        } catch (ModelNotFoundException $ex) {
            return ResponseHelper::error(ErrorCode::BAD_REQUEST, 'Topic does not exist');
        } catch (\Exception $ex) {
            return ResponseHelper::error(ErrorCode::INTERNAL_ERROR, $ex->getMessage(),
                ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
