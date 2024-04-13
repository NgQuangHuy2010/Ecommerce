<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    protected $fillable = ["id_user", "ship", "total","payment","timeship", "note","created_at", "status_order",];
    protected $primarykey = "id_order";
    public $timestamps = true;
}
