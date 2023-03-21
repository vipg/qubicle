<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDocDetails extends Model
{
    use HasFactory;
    protected $table = 'vendor_doc_details';
    protected $primaryKey = 'id';
    protected $fillable = ['docName'];
    public $timestamps = false;
}
