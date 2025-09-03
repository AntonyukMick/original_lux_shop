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
        Schema::create('pickup_points', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название пункта выдачи
            $table->string('address'); // Адрес
            $table->string('city'); // Город
            $table->decimal('latitude', 10, 8)->nullable(); // Широта для карты
            $table->decimal('longitude', 11, 8)->nullable(); // Долгота для карты
            $table->string('phone')->nullable(); // Телефон
            $table->text('working_hours')->nullable(); // Часы работы
            $table->text('description')->nullable(); // Описание
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_points');
    }
};
