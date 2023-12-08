<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\StoryContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 清空資料庫的故事內容資料
        DB::connection('mongodb')->table('storyContent')->delete();

        $originalStorySentences = [
            "Once upon a time there was a cute little girl",
        ];

        // 初始化編號計數器和情緒屬性
        $sentenceNumber = 0;
        $emotions = ['2849', '900', '700', '434', '1500', '2600', '1100, 2077'];

        // 建立一個空陣列來儲存帶有編號和情緒屬性的故事內容
        $storyContent = [];

        foreach ($originalStorySentences as $sentence) {
            // 隨機選擇一個情緒
            $randomEmotion = $emotions[array_rand($emotions)];

            // 去除句子前後可能的空白
            $sentence = trim($sentence);

            // 加上編號和情緒屬性
            $numberedSentence = [
                'sentenceId' => $sentenceNumber,
                'sentence' => $sentence,
                'emotion' => $randomEmotion,
            ];

            // 將帶有編號和情緒屬性的句子加入到陣列中
            $storyContent[] = $numberedSentence;

            // 增加編號計數器
            $sentenceNumber++;
        }

        // 建立故事內容資料
        StoryContent::create([
            'storyName' => 'Little Red Riding Hood',
            'storyContent' => $storyContent,
        ]);
    }
}
