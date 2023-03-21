<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackageDetail extends Model
{
    use HasFactory;
    protected $table = 'order_package_details';
    protected $primaryKey = 'id';
}
