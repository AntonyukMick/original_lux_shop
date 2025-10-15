<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TelegramPdfService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramPdfServiceTest extends TestCase
{
    /**
     * Тест создания сервиса
     */
    public function test_service_can_be_instantiated()
    {
        $service = new TelegramPdfService();
        $this->assertInstanceOf(TelegramPdfService::class, $service);
    }

    /**
     * Тест форматирования сообщения о заказе
     */
    public function test_order_message_formatting()
    {
        $service = new TelegramPdfService();
        
        $cartItems = [
            [
                'title' => 'Тестовый товар',
                'price' => 25.00,
                'quantity' => 2
            ]
        ];
        
        $customerData = [
            'name' => 'Тестовый клиент',
            'telegram_tag' => '@testuser'
        ];
        
        $totalAmount = 50.00;
        $orderNumber = 'ORD-TEST-1234';
        
        // Используем рефлексию для доступа к приватному методу
        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('formatOrderMessage');
        $method->setAccessible(true);
        
        $message = $method->invoke($service, $orderNumber, $cartItems, $customerData, $totalAmount);
        
        $this->assertStringContainsString('НОВЫЙ ЗАКАЗ #ORD-TEST-1234', $message);
        $this->assertStringContainsString('Тестовый клиент', $message);
        $this->assertStringContainsString('@testuser', $message);
        $this->assertStringContainsString('Тестовый товар', $message);
        $this->assertStringContainsString('50€', $message);
    }

    /**
     * Тест обработки пустых данных клиента
     */
    public function test_empty_customer_data_handling()
    {
        $service = new TelegramPdfService();
        
        $cartItems = [
            [
                'title' => 'Товар без клиента',
                'price' => 10.00,
                'quantity' => 1
            ]
        ];
        
        $customerData = [];
        $totalAmount = 10.00;
        $orderNumber = 'ORD-NO-CUSTOMER-1234';
        
        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('formatOrderMessage');
        $method->setAccessible(true);
        
        $message = $method->invoke($service, $orderNumber, $cartItems, $customerData, $totalAmount);
        
        $this->assertStringContainsString('НОВЫЙ ЗАКАЗ #ORD-NO-CUSTOMER-1234', $message);
        $this->assertStringContainsString('Товар без клиента', $message);
        $this->assertStringNotContainsString('Клиент:', $message);
    }
}
