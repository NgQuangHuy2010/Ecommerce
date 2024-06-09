<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Permission extends Model
{
    protected $table = "role_permissions";
    protected $fillable = ["permission_id","role_id"];
    protected $primarykey = "id";
    public $timestamps = false;
}
