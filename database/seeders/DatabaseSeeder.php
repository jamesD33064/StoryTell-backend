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
        // 建立故事內容資料
        StoryContent::create([
            'storyName' => 'Little Red Riding Hood',
            'storyContent' => 'init',
        ]);
    }
}
