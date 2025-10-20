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
        // Обновляем существующие размеры из JSON формата в строковый формат
        $products = DB::table('products')->whereNotNull('sizes')->get();
        
        foreach ($products as $product) {
            $sizes = $product->sizes;
            
            // Если размеры в JSON формате, конвертируем в строку
            if (is_string($sizes) && str_starts_with($sizes, '[') && str_ends_with($sizes, ']')) {
                $decodedSizes = json_decode($sizes, true);
                if (is_array($decodedSizes)) {
                    $stringSizes = implode(',', $decodedSizes);
                    DB::table('products')
                        ->where('id', $product->id)
                        ->update(['sizes' => $stringSizes]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Возвращаем размеры обратно в JSON формат
        $products = DB::table('products')->whereNotNull('sizes')->get();
        
        foreach ($products as $product) {
            $sizes = $product->sizes;
            
            // Если размеры в строковом формате, конвертируем в JSON
            if (is_string($sizes) && !str_starts_with($sizes, '[')) {
                $arraySizes = array_map('trim', explode(',', $sizes));
                $jsonSizes = json_encode($arraySizes);
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['sizes' => $jsonSizes]);
            }
        }
    }
};