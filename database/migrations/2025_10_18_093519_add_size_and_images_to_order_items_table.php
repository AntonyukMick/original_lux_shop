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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('size')->nullable()->after('quantity');
            $table->json('images')->nullable()->after('product_image');
            $table->string('category')->nullable()->after('size');
            $table->string('subcategory')->nullable()->after('category');
            $table->string('brand')->nullable()->after('subcategory');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['size', 'images', 'category', 'subcategory', 'brand']);
        });
    }
};
