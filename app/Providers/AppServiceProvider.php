<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Автоматически гарантируем наличие симлинка public/storage
        try {
            $publicStorageLink = public_path('storage');
            $publicDiskRoot = config('filesystems.disks.public.root');

            // Создаем целевую директорию, если её нет
            if ($publicDiskRoot && !is_dir($publicDiskRoot)) {
                @mkdir($publicDiskRoot, 0775, true);
            }

            // Пересоздаем линк, если он отсутствует или это не симлинк
            if (!is_link($publicStorageLink)) {
                if (File::exists($publicStorageLink)) {
                    if (File::isDirectory($publicStorageLink)) {
                        File::deleteDirectory($publicStorageLink);
                    } else {
                        File::delete($publicStorageLink);
                    }
                }
                Artisan::call('storage:link');
            }
        } catch (\Throwable $e) {
            // Тихо игнорируем на случай ограничений окружения
        }
    }
}
