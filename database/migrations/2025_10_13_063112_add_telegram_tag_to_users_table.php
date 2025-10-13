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
        Schema::table('users', function (Blueprint $table) {
            // Добавляем поле telegram_tag
            $table->string('telegram_tag')->unique()->after('name');
            
            // Делаем email необязательным
            $table->string('email')->nullable()->change();
            
            // Удаляем уникальный индекс с email если нужно
            $table->dropUnique(['email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Удаляем поле telegram_tag
            $table->dropColumn('telegram_tag');
            
            // Возвращаем email обязательным
            $table->string('email')->nullable(false)->change();
            
            // Возвращаем уникальный индекс на email
            $table->unique('email');
        });
    }
};
