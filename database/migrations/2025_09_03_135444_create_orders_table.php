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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Уникальный номер заказа
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');
            $table->string('shipping_country')->default('Россия');
            $table->text('notes')->nullable(); // Дополнительные заметки
            $table->decimal('subtotal', 10, 2); // Сумма без доставки
            $table->decimal('shipping_cost', 10, 2)->default(0); // Стоимость доставки
            $table->decimal('total', 10, 2); // Общая сумма
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->enum('payment_method', ['card', 'cash', 'bank_transfer'])->default('card');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('tracking_number')->nullable(); // Номер отслеживания
            $table->timestamp('shipped_at')->nullable(); // Дата отправки
            $table->timestamp('delivered_at')->nullable(); // Дата доставки
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
