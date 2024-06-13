<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table="account";
    protected $primarykey="id";
    protected $fillable = ["email", "fullname","phone", "status"];
    protected $hidden =["password","remember_token" ];
    public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'account_role', 'account_id', 'role_id');
    }
    public function hasPermission($permission)
    {
        // Kiểm tra xem người dùng có vai trò nào có quyền này không
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }
    public function isAdminHighest()
    {
      // Tìm vai trò của tài khoản từ bảng trung gian Account_role
    $role = Role::find($this->id);
    
    // Kiểm tra nếu vai trò tồn tại và có tên là 'Quản trị viên'
    return $role && $role->name_role == 'Quản trị viên';
    }
}
