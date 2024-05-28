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
    protected $fillable = ["email", "fullname","phone","role", "status"];
    protected $hidden =["password","remember_token" ];
    public $timestamps = false;

}
