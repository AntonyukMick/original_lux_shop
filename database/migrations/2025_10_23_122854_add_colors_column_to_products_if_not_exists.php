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
        // Проверяем, существует ли колонка colors в таблице products
        if (!Schema::hasColumn('products', 'colors')) {
            Schema::table('products', function (Blueprint $table) {
                $table->json('colors')->nullable()->comment('Цвета товара в HEX формате');
            });
            echo "Колонка 'colors' добавлена в таблицу 'products'\n";
        } else {
            echo "Колонка 'colors' уже существует в таблице 'products'\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'colors')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('colors');
            });
            echo "Колонка 'colors' удалена из таблицы 'products'\n";
        }
    }
};
