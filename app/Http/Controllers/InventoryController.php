<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\OPCenterClient;
use Illuminate\Support\Facades\Storage;
use PDF;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class InventoryController extends Controller
{
    public function index() {
        $date = now()->toDateString();
        $time = now()->toTimeString();

        $clientData = OPCenterClient::with('inventory')->first()->toArray();
        
        $onHandColumn = array_column($clientData['inventory'], 'on_hand');
        $totalOnHand = array_sum($onHandColumn);
        
        $availableColumn = array_column($clientData['inventory'], 'available');
        $totalAvailable = array_sum($availableColumn);
        
        $allocatedColumn = array_column($clientData['inventory'], 'allocated');
        $totalAllocated = array_sum($allocatedColumn);
        
        $data = [ 'data' => $clientData, 'totalOnHand' => $totalOnHand, 'totalAvailable' => $totalAvailable, 'totalAllocated' => $totalAllocated, 'date' => $date, 'time' => $time];

        $html = View::make('pdf.export', $data)->render();

        $pdf = new Dompdf();

        $pdf->loadHtml($html);
        $pdf->setPaper('A4');
        $pdf->render();

        $fileName = 'export.pdf';
        $filePath = 'public/downloads/' . $fileName;
        Storage::put($filePath, $pdf->output());

        return $pdf->stream('export.pdf');
    }
}
