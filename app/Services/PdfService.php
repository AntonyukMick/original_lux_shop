<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    /**
     * Генерировать PDF заказа
     */
    public function generateOrderPdf(array $cartItems, float $totalAmount): \Barryvdh\DomPDF\PDF
    {
        $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $orderDate = date('d.m.Y H:i');
        
        $data = [
            'orderNumber' => $orderNumber,
            'orderDate' => $orderDate,
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount,
            'companyName' => 'ORIGINAL | LUX SHOP',
            'companyEmail' => 'info@luxshop.ru'
        ];
        
        $pdf = Pdf::loadView('pdf.order', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);
        
        return $pdf;
    }

    /**
     * Получить имя файла для PDF
     */
    public function generateFilename(string $orderNumber): string
    {
        return 'order_' . $orderNumber . '_' . date('Y-m-d_H-i-s') . '.pdf';
    }

    /**
     * Генерировать PDF заказа из запроса
     */
    public function generateOrderPdfFromRequest(\App\Http\Requests\PdfRequest $request): \Barryvdh\DomPDF\PDF
    {
        $cartItems = $request->getCartItems();
        $totalAmount = $request->getTotalAmount();
        
        return $this->generateOrderPdf($cartItems, $totalAmount);
    }
}
