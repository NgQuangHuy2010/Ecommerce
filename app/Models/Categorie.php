<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = "categorie";
    protected $fillable = ["name", "keyword", "desc","image","status"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany(Products::class, 'idcat', 'id');
    }
}
