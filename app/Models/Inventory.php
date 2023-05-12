<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OPCenterClient;

class Inventory extends Model
{
    use HasFactory;

    protected $table = "inventory";

    public function client() {
        return $this->belongsTo(OPCenterClient::class, 'client_id', 'client_id');
    }
}
