<?php

namespace App\Http\Controllers;

use App\Services\PdfService;

class TestPdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function test()
    {
        $pdf = $this->pdfService->generateTestPdf();
        return $pdf->stream('test.pdf');
    }
}

