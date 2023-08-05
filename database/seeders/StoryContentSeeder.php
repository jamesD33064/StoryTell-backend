<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\StoryContent;

class StoryContentSeeder extends Seeder
{
    public function run()
    {
        // 清空資料庫的故事內容資料
        DB::connection('mongodb')->table('storyContent')->delete();

        $originalStorySentences = [
            "Once upon a time there was a cute little girl",
            "Anyone who saw the child loved him, but especially the grandmother, who seemed to love him so much that there was nothing he wouldn't give to the child.",
            "Once my grandmother gave me a red velvet hood",
            "So the three were happy",
            "The hunter skinned the wolf and took it home",
            "Grandmother ate the cake that Little Red Riding Hood brought and drank the wine, but Little Red Riding Hood (from now on, when Mother says she shouldn't, she won't leave the road and run into the woods alone.",
            "I thought",
            "There was also a story like this",
            "Once, when Little Red Riding Hood was bringing cake to the old woman, another wolf spoke to her and invited her to get off the road.",
            "But Little Red Riding Hood was wary, went straight ahead, and told the old woman, I met a wolf, who said good morning to me, but his eyes were so bad, if I hadn't been in the way they were walking I said you must have eaten",
            "Well then, said the old woman",
            "Let's close the door so the wolf doesn't come in.",
            "Shortly afterwards the wolf knocked on the door and said, 'Grandmother, open the door, Little Red Riding Hood, I'm bringing you a cake.",
            "But they didn't say a word and didn't open the door.",
            "So Graybeard Wolf stalked around the house a few times and finally jumped on the roof.",
        ];

        // 初始化編號計數器和情緒屬性
        $sentenceNumber = 1;
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
