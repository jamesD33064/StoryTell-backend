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

    public function createStoryContent($parameter){
        
        $base64String = $parameter['storyContent'];
        $csvData = base64_decode($base64String);
        $csvData = mb_convert_encoding($csvData, 'UTF-8');
        $csvArray = str_getcsv($csvData, "\n");

        $storyContent = [];
        foreach ($csvArray as $index => $item) {
            if ($index === 0) {
                continue;
            }
    
            $csvData = str_getcsv($item, '|');
    
            $sentenceId = $index - 1;
            $sentence = $csvData[0];
            $emotion = end($csvData);

            $storyContent[] = [
                'sentenceId' => $sentenceId,
                'sentence' => $sentence,
                'emotion' => $emotion,
            ];
        }

        $result = $this->storyContentRepository->createStoryContent($parameter['storyName'], $parameter['storyImg'], $parameter['storyLang'], $storyContent);

        return json_encode($result);
    }
}
