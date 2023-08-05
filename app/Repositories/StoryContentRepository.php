<?php

namespace App\Repositories;

use App\Models\StoryContent;

class StoryContentRepository {
    private $storyContent;

    public function __construct()
    {
        $this->storyContent = new StoryContent();
    }

    public function getStoryContent($storyId){
        return $this->storyContent::find($storyId);
    }

}

