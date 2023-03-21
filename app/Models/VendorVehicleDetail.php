<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorVehicleDetail extends Model
{
    use HasFactory;
    protected $table = 'vendor_vehicle_details';
    protected $primaryKey = 'id';
    protected $fillable = ['carPrice'];
    public $timestamps = false;
}
