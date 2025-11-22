<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PromotionsController extends Controller
{
    /**
     * Показать страницу акций с изображениями
     */
    public function index(Request $request)
    {
        return view('promotions');
    }
}