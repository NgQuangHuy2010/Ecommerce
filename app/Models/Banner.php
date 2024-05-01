<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banner";
    protected $fillable = ["image_first","image_second","image_third"];
    protected $primarykey = "id";
    public $timestamps = false;
}
