<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    protected $table = "orderdetails";
    protected $fillable = ["id_product","quantity", "id_order","status","created_at"];
    protected $primarykey = "id_detail ";
    public $timestamps = true;
}
