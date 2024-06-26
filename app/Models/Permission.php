<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ["name"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
