<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";
    protected $fillable = ["account_id", "name_role"];
    protected $primarykey = "id";
    public $timestamps = false;
   
}
