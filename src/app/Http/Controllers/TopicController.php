<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exceptions\DuplicateException;
use App\Services\TopicService;
use App\Utilities\ResponseHelper;
use App\Utilities\ErrorCode;

class TopicController extends Controller
{
    private $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function store(Request $request)
    {
        try {
            $topicData = $request->all();
            $topic = $this->topicService->createTopic($topicData);

            return ResponseHelper::success($topic, 201);
        } catch (DuplicateException $ex) {
            return ResponseHelper::error(ErrorCode::BAD_REQUEST, 'Topic already exists');
        } catch (\Exception $ex) {
            return ResponseHelper::error(ErrorCode::INTERNAL_ERROR, $ex->getMessage(),
                ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
