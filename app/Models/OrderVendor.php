<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderVendor extends Model
{
    use HasFactory;
    protected $table = 'order_vendor';
    protected $primaryKey = 'id';
    protected $fillable = ['email'];

    public function bankDetails()
    {
        return $this->hasOne(VendorBankDetail::class, 'vendor_id');
    }

    public function docDetails()
    {
        return $this->hasOne(VendorDocDetails::class, 'vendor_id');
    }

    public function address()
    {
        return $this->hasOne(VendorAddress::class, 'vendor_id');
    }

    public function vehicleDetails()
    {
        return $this->hasOne(VendorVehicleDetail::class, 'vendor_id');
    }
    public function deviceDetails()
    {
        return $this->hasOne(VendorDeviceDetail::class, 'vendor_id');
    }
}
