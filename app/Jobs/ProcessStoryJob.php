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
    public $storyLang;
    public $storyContent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($storyId, $storyLang, $storyContent)
    {
        $this->storyId = $storyId;
        $this->storyLang = $storyLang;
        $this->storyContent = $storyContent;
        Log::info("[ProcessStoryJob]生成語音:" . json_encode([$this->storyId, $this->storyLang, $this->storyContent]));
        Log::info("[ProcessStoryJob]生成語音:" . $this->storyLang);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $port = $this->storyLang == "C" ? "5000" : "5001";

        $client = new Client([
            'base_uri' => 'http://host.docker.internal:5001',
            // 'base_uri' => 'http://host.docker.internal:' . $port,
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
                Log::info($this->storyId . 'gen_story成功' . $e->getResponse()->getBody());
            } else {
                Log::error('gen_story請求失敗：' . $e->getMessage() . json_encode([
                    'storyId' => $this->storyId,
                    'storyContent' => $this->storyContent,
                ],));
            }
        }
    }
}
