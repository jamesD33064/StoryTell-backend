<?php

namespace App\Repositories;

use App\Models\StoryAudio;

class StoryAudioRepository {
    private $storyAudio;

    public function __construct()
    {
        $this->storyAudio = new StoryAudio();
    }

    public function getStoryAudio($storyName, $id)
    {
        // return $this->storyAudio;
        $id = str_pad($id, 3, '0', STR_PAD_LEFT);
        return '/wav/'.$storyName.'/output_'.$id.'.wav';
    }
}

