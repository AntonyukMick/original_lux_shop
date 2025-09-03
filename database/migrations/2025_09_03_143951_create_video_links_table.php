<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_links', function (Blueprint $table) {
            $table->id();
            $table->string('language', 10); // ru, en, de
            $table->string('title'); // Название видео
            $table->text('youtube_url'); // Ссылка на YouTube
            $table->string('youtube_id')->nullable(); // ID видео на YouTube
            $table->text('description')->nullable(); // Описание видео
            $table->boolean('is_active')->default(true); // Активно ли видео
            $table->integer('sort_order')->default(0); // Порядок сортировки
            $table->timestamps();
            
            // Уникальный индекс по языку
            $table->unique('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_links');
    }
};
