<?php

namespace App\Listeners;

use App\Events\UploadStory;
use App\Jobs\ProcessStoryJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class GenPredictEmotionAudio
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UploadStory  $event
     * @return void
     */
    public function handle(UploadStory $event)
    {
        try {
            Log::info("[GenPredictEmotionAudio][start]生成語音:" . json_encode([$event->storyId, $event->storyContent]));
            dispatch(new ProcessStoryJob($event->storyId, $event->storyContent));
            Log::info("[GenPredictEmotionAudio][finish]生成語音:" . json_encode([$event->storyId, $event->storyContent]));
        } catch (\Exception $e) {
            Log::error('Error dispatching ProcessStoryJob: ' . $e->getMessage());
        }
    }
}
