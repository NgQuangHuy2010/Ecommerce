<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    protected $table = 'order_details_shop';
    protected $primaryKey = 'id';
    protected $fillable =['	fullname','email','phone','address','province','district','ward','total_price','products','order_id_momo','order_id'];
    public $timestamps = false;								
    public function orderMomo()
    {
        return $this->belongsTo(OrderMomo::class, 'order_id_momo', 'id');
    }
    
}
