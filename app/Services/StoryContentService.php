<?php

namespace App\Services;

use App\Repositories\StoryContentRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class StoryContentService
{
    private $storyContentRepository;
    private $client;

    public function __construct(
        StoryContentRepository $storyContentRepository,
        // Client $client
    ) {
        $this->storyContentRepository = $storyContentRepository;
        // $this->client = $client;
        $this->client = new Client([
            'base_uri' => 'http://host.docker.internal:5000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function getAllStoryInfo()
    {
        return $this->storyContentRepository->getAllStoryInfo();
    }

    public function getStoryContent($storyId)
    {
        return $this->storyContentRepository->getStoryContent($storyId);
    }

    public function createStoryContentByCSVFile($parameter)
    {

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

    public function createStoryContentByString($parameter)
    {
        $splited = [];
        $storyContent = $parameter['storyContent'];
        $storyLang = $parameter['storyLang'];
        try {
            $response = $this->client->post('/split_sentences', [
                'json' => [
                    'storyContent' => $storyContent,
                    'storyLang' => $storyLang,
            ],
            ]);

            $splited = $response->getBody()->getContents();
            $splited = json_decode($splited);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                echo $e->getResponse()->getBody();
            } else {
                echo '請求失敗：' . $e->getMessage();
            }
        }

        $storyContent = [];
        $emotions = $splited->emotions;
        $sentences = $splited->sentences;

        foreach ($sentences as $index => $sentence) {
            $storyContent[] = [
                'sentenceId' => $index,
                'sentence' => $sentence,
                'emotion' => strval($emotions[$index]),
            ];
        }

        $storyId = $this->storyContentRepository->createStoryContent($parameter['storyName'], $parameter['storyImg'], $parameter['storyLang'], $storyContent);

        return $storyId;
    }
}
