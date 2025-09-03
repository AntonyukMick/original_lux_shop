<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VideoLink;

class VideoLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videoLinks = [
            [
                'language' => 'ru',
                'title' => 'Видео-обзор на русском языке',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'description' => 'Подробный обзор сайта ORIGINAL | LUX SHOP на русском языке',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'language' => 'en',
                'title' => 'Video review in English',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'description' => 'Detailed review of ORIGINAL | LUX SHOP website in English',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'language' => 'de',
                'title' => 'Video-Übersicht auf Deutsch',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'youtube_id' => 'dQw4w9WgXcQ',
                'description' => 'Detaillierte Übersicht der ORIGINAL | LUX SHOP Website auf Deutsch',
                'is_active' => true,
                'sort_order' => 3
            ]
        ];

        foreach ($videoLinks as $videoLink) {
            VideoLink::updateOrCreate(
                ['language' => $videoLink['language']],
                $videoLink
            );
        }
    }
}
