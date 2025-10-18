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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index(); // Для неавторизованных пользователей
            $table->unsignedBigInteger('user_id')->nullable()->index(); // Для авторизованных пользователей
            $table->unsignedBigInteger('product_id');
            $table->string('product_title');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->string('size')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
            // Уникальность: один товар с одним размером на сессию/пользователя
            $table->unique(['session_id', 'product_id', 'size'], 'unique_cart_item');
            $table->unique(['user_id', 'product_id', 'size'], 'unique_user_cart_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};