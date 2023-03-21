<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPickupAddress extends Model
{
    use HasFactory;
    protected $table = 'order_pickup_address';
    protected $primaryKey = 'id';
    protected $fillable = ['locationName'];
    public $timestamps = false;
}
