<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Проверяем, существует ли колонка gender в таблице products
        if (!Schema::hasColumn('products', 'gender')) {
            Schema::table('products', function (Blueprint $table) {
                $table->json('gender')->nullable()->comment('Пол товара (мужской/женский/унисекс)');
            });
            echo "Колонка 'gender' добавлена в таблицу 'products'\n";
        } else {
            echo "Колонка 'gender' уже существует в таблице 'products'\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'gender')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('gender');
            });
            echo "Колонка 'gender' удалена из таблицы 'products'\n";
        }
    }
};
