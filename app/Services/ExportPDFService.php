<?php

namespace App\Services;

use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class ExportPDFService 
{
    public function exportPDF($data) {
        $html = View::make('pdf.export', $data)->render();
        $pdf = new Dompdf();
        
        $pdf->loadHtml($html);
        $pdf->setPaper('A4');
        $pdf->render();
        
        $fileName = 'export_'.str_replace(':','',(string)$data['time']).'.pdf';
        $filePath = 'public/downloads/' . $fileName;
        Storage::put($filePath, $pdf->output());
        
        return $pdf->stream('export_'.str_replace(':','',(string)$data['time']).'.pdf');
    }
}