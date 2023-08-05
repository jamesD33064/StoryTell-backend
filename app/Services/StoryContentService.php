<?php

namespace App\Services;

use App\Repositories\StoryContentRepository;

class StoryContentService
{
    private $storyContentRepository;

    public function __construct()
    {
        $this->storyContentRepository = new StoryContentRepository();
    }

    public function getAllStoryNameAndID(){
        return $this->storyContentRepository->getAllStoryNameAndID();
    }

    public function getStoryContent($storyId){
        return $this->storyContentRepository->getStoryContent($storyId);
    }
}
