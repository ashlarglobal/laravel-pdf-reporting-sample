<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\OPCenterClient;
use App\Services\ExportPDFService;

class InventoryController extends Controller
{
    private $exportPDFService;
    public function __construct(ExportPDFService $exportPDFService)
    {
        $this->exportPDFService = $exportPDFService;
    }

    public function index() {
        $clients = OPCenterClient::get()->toArray();
        return view("index", compact('clients'));
    }

    public function export($id) {
        $date = now()->toDateString();
        $time = now()->toTimeString();

        $param = request()->view;

        $clientData = OPCenterClient::with(['inventories' => function($q){
            $q->where('active', 1)->where('non_stocking', 0);
        }])->where('client_id', $id)->first()->toArray();
        
        $onHandColumn = array_column($clientData['inventories'], 'on_hand');
        $totalOnHand = array_sum($onHandColumn);
        
        $availableColumn = array_column($clientData['inventories'], 'available');
        $totalAvailable = array_sum($availableColumn);
        
        $allocatedColumn = array_column($clientData['inventories'], 'allocated');
        $totalAllocated = array_sum($allocatedColumn);
        
        $data = [ 'data' => $clientData, 'totalOnHand' => $totalOnHand, 'totalAvailable' => $totalAvailable, 'totalAllocated' => $totalAllocated, 'date' => $date, 'time' => $time];

        if($param == "true"){
            return view('pdf.export', $data);
        } else{
            $this->exportPDFService->exportPDF($data);
        }

    }
}
