<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAddress extends Model
{
    use HasFactory;
    protected $table = 'vendor_address';
    protected $primaryKey = 'id';
    protected $fillable = ['locationName'];
    public $timestamps = false;
}
