<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Services\SubscriptionService;
use App\Utilities\ErrorCode;
use App\Utilities\ResponseHelper;

class SubscriptionController extends Controller
{
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function subscribeToTopic(string $topic, Request $request)
    {
        try {
            $subscriberData = $request->all();
            $subscriber = $this->subscriptionService->subscribeToTopic($topic, $subscriberData['url']);

            return ResponseHelper::success($subscriber, 201);
        } catch (ModelNotFoundException $ex) {
            return ResponseHelper::error(ErrorCode::BAD_REQUEST, 'Topic does not exist');
        } catch (\Exception $ex) {
            return ResponseHelper::error(ErrorCode::INTERNAL_ERROR, $ex->getMessage(),
                ResponseHelper::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
