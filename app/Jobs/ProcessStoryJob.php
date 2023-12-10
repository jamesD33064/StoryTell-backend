<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ProcessStoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $storyId;
    public $storyContent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($storyId, $storyContent)
    {
        $this->storyId = $storyId;
        $this->storyContent = $storyContent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'http://host.docker.internal:5000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        try {
            $response = $client->post('/gen_story', [
                'json' => [
                    'storyId' => $this->storyId,
                    'storyContent' => $this->storyContent,
                ],
            ]);

            $splited = $response->getBody()->getContents();
            $splited = json_decode($splited);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                echo $e->getResponse()->getBody();
                Log::info($this->storyId . 'gen_story成功');
            } else {
                Log::error('gen_story請求失敗：' . $e->getMessage() . json_encode([
                    'storyId' => $this->storyId,
                    'storyContent' => $this->storyContent,
                ],));
            }
        }
    }
}
