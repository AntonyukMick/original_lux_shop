<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use App\Services\TelegramPdfService;
use App\Http\Requests\PdfRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderPdfController extends Controller
{
    public function __construct(
        protected PdfService $pdfService,
        protected TelegramPdfService $telegramPdfService
    ) {}

    /**
     * Создать PDF заказа и отправить в Telegram
     */
    public function generateOrderPdfAndSend(Request $request)
    {
        try {
            $request->validate([
                'cartItems' => 'required|string',
                'totalAmount' => 'required|numeric',
                'customer_name' => 'required|string|max:255',
                'customer_telegram_tag' => 'required|string|max:50'
            ]);

            $cartItems = json_decode($request->cartItems, true);
            $totalAmount = $request->totalAmount;
            
            $customerData = [
                'name' => $request->customer_name,
                'telegram_tag' => $request->customer_telegram_tag
            ];

            // Отправляем PDF в Telegram
            $result = $this->telegramPdfService->sendOrderPdfToManager($cartItems, $totalAmount, $customerData);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Заказ успешно отправлен менеджеру! Мы свяжемся с вами в ближайшее время.',
                    'order_number' => $result['order_number']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Order PDF generation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при обработке заказа. Попробуйте еще раз.'
            ], 500);
        }
    }

    /**
     * Старый метод для скачивания PDF (оставляем для совместимости)
     */
    public function generateOrderPdf(PdfRequest $request)
    {
        $pdf = $this->pdfService->generateOrderPdfFromRequest($request);
        
        $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $filename = $this->pdfService->generateFilename($orderNumber);
        
        return $pdf->download($filename);
    }
    
    public function previewOrderPdf(PdfRequest $request)
    {
        $pdf = $this->pdfService->generateOrderPdfFromRequest($request);
        
        return $pdf->stream('order_preview.pdf');
    }
}
