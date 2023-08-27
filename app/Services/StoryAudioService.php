<?php

namespace App\Services;

use App\Repositories\StoryAudioRepository;

class StoryAudioService
{
    private $storyAudioRepository;

    public function __construct()
    {
        $this->storyAudioRepository = new StoryAudioRepository();
    }

    public function getStoryAudio($storyName, $id)
    {
        return $this->storyAudioRepository->getStoryAudio($storyName, $id);
    }
}
