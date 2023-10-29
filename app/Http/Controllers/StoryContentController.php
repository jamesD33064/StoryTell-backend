<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\StoryContentService;

class StoryContentController extends Controller
{
    private $storyContentService;

    public function __construct(
        StoryContentService $storyContentService,
    )
    {
        $this->storyContentService = $storyContentService;
    }

    public function getAllStoryInfo(){
        return $this->storyContentService->getAllStoryInfo();
    }

    public function getStoryDetail($storyId){
        return $this->storyContentService->getStoryContent($storyId);
    }
}
