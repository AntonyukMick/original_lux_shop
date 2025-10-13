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
        // Проверяем, существует ли уже колонка telegram_tag
        if (!Schema::hasColumn('users', 'telegram_tag')) {
            Schema::table('users', function (Blueprint $table) {
                // Добавляем поле telegram_tag
                $table->string('telegram_tag')->nullable()->after('name');
                
                // Делаем email необязательным если он обязательный
                if (Schema::hasColumn('users', 'email')) {
                    $table->string('email')->nullable()->change();
                }
            });
            
            // Добавляем уникальный индекс для telegram_tag
            Schema::table('users', function (Blueprint $table) {
                $table->unique('telegram_tag');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Удаляем поле telegram_tag если оно существует
            if (Schema::hasColumn('users', 'telegram_tag')) {
                $table->dropUnique(['telegram_tag']);
                $table->dropColumn('telegram_tag');
            }
            
            // Возвращаем email обязательным
            if (Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable(false)->change();
            }
        });
    }
};
