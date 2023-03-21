<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    
    public function dropoffAddress()
    {
        return $this->hasOne(OrderDropoffAddress::class, 'order_id');
    }

    public function pickupAddress()
    {
        return $this->hasOne(OrderPickupAddress::class, 'order_id');
    }

    public function packageDetails()
    {
        return $this->hasOne(OrderPackageDetail::class, 'order_id');
    }

    public function vendor()
    {
        return $this->hasOne(OrderVendor::class, 'order_id');
    }
}
