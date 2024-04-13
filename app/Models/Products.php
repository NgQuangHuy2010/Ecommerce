<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "product";
    protected $fillable = ["name", "keyword", "desc", "content","price","image","images","idcat","status"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function categories()
    {
        return $this->belongsTo(Categorie::class, 'idcat', 'id');
    }
}
