<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Services\PdfService;

class TelegramPdfService
{
    private $botToken;
    private $managerChatId;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->managerChatId = '@antonyuknikita7'; // Ваш Telegram тег
    }

    /**
     * Создать PDF заказа и отправить в Telegram
     */
    public function sendOrderPdfToManager(array $cartItems, float $totalAmount, array $customerData = [])
    {
        try {
            // Создаем PDF
            $pdfService = app(PdfService::class);
            $pdf = $pdfService->generateOrderPdf($cartItems, $totalAmount);
            
            // Генерируем имя файла
            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $filename = 'order_' . $orderNumber . '_' . date('Y-m-d_H-i-s') . '.pdf';
            
            // Создаем папку temp если её нет
            $tempDir = storage_path('app/temp');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }
            
            // Сохраняем PDF во временную папку
            $tempPath = $tempDir . '/' . $filename;
            $pdf->save($tempPath);
            
            // Отправляем сообщение с информацией о заказе
            $message = $this->formatOrderMessage($orderNumber, $cartItems, $customerData, $totalAmount);
            $this->sendMessage($message);
            
            // Отправляем PDF файл
            $this->sendDocument($tempPath, $filename, $orderNumber);
            
            // Удаляем временный файл
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
            
            return [
                'success' => true,
                'order_number' => $orderNumber,
                'message' => 'PDF заказа отправлен менеджеру в Telegram'
            ];
            
        } catch (\Exception $e) {
            Log::error('Telegram PDF sending error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => 'Ошибка при отправке PDF в Telegram: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Отправить текстовое сообщение
     */
    private function sendMessage(string $message)
    {
        $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'chat_id' => $this->managerChatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ]);

        if (!$response->successful()) {
            Log::error('Telegram message sending failed', [
                'response' => $response->body(),
                'status' => $response->status()
            ]);
        }

        return $response->successful();
    }

    /**
     * Отправить PDF документ
     */
    private function sendDocument(string $filePath, string $filename, string $orderNumber)
    {
        $response = Http::attach('document', file_get_contents($filePath), $filename)
            ->post("https://api.telegram.org/bot{$this->botToken}/sendDocument", [
                'chat_id' => $this->managerChatId,
                'caption' => "📄 PDF заказа #{$orderNumber}",
                'parse_mode' => 'HTML'
            ]);

        if (!$response->successful()) {
            Log::error('Telegram document sending failed', [
                'response' => $response->body(),
                'status' => $response->status()
            ]);
        }

        return $response->successful();
    }

    /**
     * Форматировать сообщение о заказе
     */
    private function formatOrderMessage(string $orderNumber, array $cartItems, array $customerData, float $totalAmount): string
    {
        $message = "🛒 <b>НОВЫЙ ЗАКАЗ #{$orderNumber}</b>\n\n";
        
        if (!empty($customerData)) {
            $message .= "👤 <b>Клиент:</b>\n";
            if (isset($customerData['name'])) {
                $message .= "• Имя: {$customerData['name']}\n";
            }
            if (isset($customerData['telegram_tag'])) {
                $message .= "• Telegram: {$customerData['telegram_tag']}\n";
            }
            if (isset($customerData['phone'])) {
                $message .= "• Телефон: {$customerData['phone']}\n";
            }
            if (isset($customerData['address'])) {
                $message .= "• Адрес: {$customerData['address']}\n";
            }
            $message .= "\n";
        }
        
        $message .= "📦 <b>Товары:</b>\n";
        foreach ($cartItems as $item) {
            $message .= "• {$item['title']} - {$item['price']}€ x {$item['quantity']}\n";
        }
        
        $message .= "\n💰 <b>Итого: {$totalAmount}€</b>\n";
        $message .= "📅 " . now()->format('d.m.Y H:i') . "\n\n";
        $message .= "📄 <i>PDF файл с деталями заказа прикреплен ниже</i>";
        
        return $message;
    }
}
