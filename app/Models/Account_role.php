<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_role extends Model
{
    protected $table = "account_role";
    protected $fillable = ["account_id","role_id"];
    protected $primarykey = "id";
    public $timestamps = false;
  
}

