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

        $topic = $this->topic->where('title', $topic)->first();

        if (empty($topic)) {
            throw new ModelNotFoundException('Topic does not exist');
        }

        $topicSubscriberEntry = $topic->subscribers()->wherePivot('subscriber_id',
            $subscriber->id)->get();

        if (count($topicSubscriberEntry) == 0) {
            $topic->subscribers()->attach($subscriber->id);
        }

        return [
            'url'   => $url,
            'topic' => $topic->title,
        ];
    }
}
