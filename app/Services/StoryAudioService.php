<?php

namespace App\Services;

use App\Repositories\StoryAudioRepository;

class StoryAudioService
{
    private $storyAudioRepository;

    public function __construct(
        StoryAudioRepository $storyAudioRepository
    )
    {
        $this->storyAudioRepository = $storyAudioRepository;
    }

    public function getStoryAudio($storyName, $lang, $speaker, $emotion, $id)
    {
        return $this->storyAudioRepository->getStoryAudio($storyName, $lang, $speaker, $emotion, $id);
    }
}
