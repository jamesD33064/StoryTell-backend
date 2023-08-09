<?php

namespace App\Repositories;

use App\Models\StoryContent;

class StoryContentRepository {
    private $storyContent;

    public function __construct()
    {
        $this->storyContent = new StoryContent();
    }

    public function getAllStoryInfo(){
        // return $this->storyContent::select('_id', 'storyName')->get();
        $data = $this->storyContent::select('_id', 'storyName')->get();
        return json_encode($data);
    }

    public function getStoryContent($storyId){
        return $this->storyContent::find($storyId);
    }

}

