<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'title',
        'youtube_url',
        'youtube_id',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Получить активные видео-ссылки
     */
    public static function getActive()
    {
        return self::where('is_active', true)
                   ->orderBy('sort_order')
                   ->get();
    }

    /**
     * Получить видео по языку
     */
    public static function getByLanguage($language)
    {
        return self::where('language', $language)
                   ->where('is_active', true)
                   ->first();
    }

    /**
     * Извлечь YouTube ID из URL
     */
    public function extractYoutubeId()
    {
        $url = $this->youtube_url;
        
        // Паттерны для извлечения ID из разных форматов YouTube URL
        $patterns = [
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
            '/youtu\.be\/([a-zA-Z0-9_-]+)/',
            '/youtube\.com\/v\/([a-zA-Z0-9_-]+)/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                $this->youtube_id = $matches[1];
                return $this->youtube_id;
            }
        }

        return null;
    }

    /**
     * Получить embed URL для YouTube
     */
    public function getEmbedUrl()
    {
        if ($this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }
        
        return null;
    }

    /**
     * Получить название языка
     */
    public function getLanguageName()
    {
        $languages = [
            'ru' => 'Русский',
            'en' => 'English',
            'de' => 'Deutsch'
        ];

        return $languages[$this->language] ?? $this->language;
    }
}
