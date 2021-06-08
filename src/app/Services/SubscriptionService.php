<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Subscriber;
use App\Models\Topic;

class SubscriptionService
{
    private $topic;
    private $subscriber;

    public function __construct(Topic $topic, Subscriber $subscriber)
    {
        $this->topic = $topic;
        $this->subscriber = $subscriber;
    }

    public function subscribeToTopic($topic, $url)
    {
        $subscriber = $this->subscriber->where('url', $url)->first();

        if (empty($subscriber)) {
            $subscriber = $this->subscriber->create([ 'url' => $url ]);
        }

        $topicModel = $this->topic->where('title', $topic)->first();

        if (empty($topicModel)) {
            $topicModel = $this->topic->create(['title' => $topic]);
        }

        $topicSubscriberEntry = $topicModel->subscribers()->wherePivot('subscriber_id',
            $subscriber->id)->get();

        if (count($topicSubscriberEntry) == 0) {
            $topicModel->subscribers()->attach($subscriber->id);
        }

        return [
            'url'   => $url,
            'topic' => $topicModel->title,
        ];
    }
}
