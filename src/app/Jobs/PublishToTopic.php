<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Topic;
use App\Utilities\RequestHelper;

class PublishToTopic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($topic, $data)
    {
        $this->data     = $data;
        $this->topic    = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $topicModel = new Topic();

        $subscriberUrls = [];
        $topic = $topicModel->where('title', $this->topic)->first();

        if (empty($topic)) {
            throw new ModelNotFoundException('Topic does not exist');
        }

        foreach ($topic->subscribers as $subscriber) {
            $url = $subscriber->url;

            $subscriberUrls[] = $url;

            $processedData = [];
            $processedData['topic'] = $this->topic;
            $processedData['data'] = $this->data;

            try {
                RequestHelper::post($url, $processedData);

                // TODO: add error handling for failed requests
                Log::info('Published message to subscriber ' . $url);
            } catch (Exception $exception) {
            }
        }
    }
}
