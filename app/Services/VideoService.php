<?php

namespace App\Services;

use App\Models\VideoLink;

class VideoService
{
    /**
     * Получить все видео-ссылки
     */
    public function getAllVideos()
    {
        return VideoLink::orderBy('sort_order')->get();
    }

    /**
     * Сохранить видео-ссылку
     */
    public function storeVideo(array $data): VideoLink
    {
        $videoLink = VideoLink::updateOrCreate(
            ['language' => $data['language']],
            [
                'title' => $data['title'],
                'youtube_url' => $data['youtube_url'],
                'description' => $data['description'] ?? null,
                'is_active' => $data['is_active'] ?? false,
                'sort_order' => $data['sort_order'] ?? 0
            ]
        );

        // Извлекаем YouTube ID
        $videoLink->extractYoutubeId();
        $videoLink->save();

        return $videoLink;
    }

    /**
     * Удалить видео-ссылку
     */
    public function deleteVideo(int $id): bool
    {
        $videoLink = VideoLink::find($id);
        if ($videoLink) {
            $videoLink->delete();
            return true;
        }
        return false;
    }
}
