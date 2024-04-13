<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = "categorie";
    protected $fillable = ["name", "keyword", "desc","image", "level","status"];
    protected $primarykey = "id";
    public $timestamps = true;
    public function products()
    {
        return $this->hasMany(Products::class, 'idcat', 'id');
    }
}
