<?php

namespace App\Repositories;

use App\Models\StoryAudio;

class StoryAudioRepository {
    private $storyAudio;

    public function __construct()
    {
        $this->storyAudio = new StoryAudio();
    }

    public function getStoryAudio($storyName, $lang, $speaker, $emotion, $id)
    {
        // $pathToFile = 'D:\StoryTell-backend\public\wav\\';
        $pathToFile = '/var/www/html/public/wav/';
        $pathToFile .= $storyName . '/';
        $pathToFile .= $lang . '/';
        $pathToFile .= $speaker . '/';
        $pathToFile .= $emotion . '/';
        $pathToFile .= $id . '.wav';

        return response()->file($pathToFile);
    }
}

