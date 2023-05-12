<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;

class OPCenterClient extends Model
{
    use HasFactory;

    protected $table = "opcenter_client";

    public function inventories() {
        return $this->hasMany(Inventory::class, 'client_id', 'client_id');
    }
}
