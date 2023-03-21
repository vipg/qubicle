<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDeviceDetail extends Model
{
    use HasFactory;
    protected $table = 'vendor_device_details';
    protected $primaryKey = 'id';
    protected $fillable = ['token'];
    public $timestamps = false;
}
