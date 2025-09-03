<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название метода доставки
            $table->string('type'); // standard, express, pickup
            $table->decimal('base_cost', 8, 2); // Базовая стоимость
            $table->decimal('cost_per_km', 8, 2)->default(0); // Стоимость за км
            $table->integer('min_days'); // Минимальное количество дней
            $table->integer('max_days'); // Максимальное количество дней
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_methods');
    }
};
