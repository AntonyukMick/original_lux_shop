<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use App\Http\Requests\PdfRequest;

class OrderPdfController extends Controller
{
    public function __construct(protected PdfService $pdfService)
    {}

    public function generateOrderPdf(PdfRequest $request)
    {
        $pdf = $this->pdfService->generateOrderPdfFromRequest($request);
        
        // Генерируем имя файла
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
