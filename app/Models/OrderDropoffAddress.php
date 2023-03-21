<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDropoffAddress extends Model
{
    use HasFactory;
    protected $table = 'order_dropoff_address';
    protected $primaryKey = 'id';
    protected $fillable = ['mapLink'];
    public $timestamps = false;
}
