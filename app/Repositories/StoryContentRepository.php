<?php

namespace App\Repositories;

use App\Models\StoryContent;

class StoryContentRepository
{
    private $storyContent;

    public function __construct()
    {
        $this->storyContent = new StoryContent();
    }

    public function getAllStoryInfo(){
        $data = $this->storyContent::select('_id', 'storyName', 'storyImg')->get();

        return json_encode($data);
    }

    public function getStoryContent($storyId){
        return $this->storyContent::find($storyId);
    }

    public function createStoryContent($storyName, $storyImg, $storyLang, $storyContent){
        $result = $this->storyContent->fill([
            "storyName" => $storyName,
            "storyImg" => "",
            "storyLang" => $storyLang,
            "storyContent" => $storyContent,
        ])->save();

        return $result;
    }
}

