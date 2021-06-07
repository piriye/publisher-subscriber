<?php

namespace App\Services;

use App\Exceptions\DuplicateException;
use App\Models\Topic;

class TopicService
{
    private $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getTopic($title)
    {
        return $this->topic->where('title', $title)->first();
    }

    public function createTopic($topicData)
    {
        $topic = $this->topic->where('title', $topicData['title'])->first();

        if (!empty($topic)) {
            throw new DuplicateException();
        }

        return $this->topic->create($topicData);
    }
}
