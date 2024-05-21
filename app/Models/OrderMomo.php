<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMomo extends Model
{
    protected $table = 'order_momo';
    protected $primaryKey = 'id';
    protected $fillable =['	partner_code','order_id','amount','order_info','created_at','updated_at'];
    public $timestamps = true;
}
