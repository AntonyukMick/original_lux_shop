<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('tracking_number')->unique(); // Номер отслеживания
            $table->string('status'); // Статус доставки
            $table->string('location')->nullable(); // Текущее местоположение
            $table->text('description')->nullable(); // Описание статуса
            $table->timestamp('estimated_delivery')->nullable(); // Ожидаемая дата доставки
            $table->timestamp('actual_delivery')->nullable(); // Фактическая дата доставки
            $table->json('tracking_history')->nullable(); // История отслеживания
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_tracking');
    }
};
