<?php

namespace App\Services;

use App\Repositories\StoryContentRepository;

class StoryContentService
{
    private $storyContentRepository;

    public function __construct(
        StoryContentRepository $storyContentRepository
    )
    {
        $this->storyContentRepository = $storyContentRepository;
    }

    public function getAllStoryInfo(){
        return $this->storyContentRepository->getAllStoryInfo();
    }

    public function getStoryContent($storyId){
        return $this->storyContentRepository->getStoryContent($storyId);
    }
}
