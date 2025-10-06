<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{

    use HasFactory;
    protected $table = 'categorys'; // Specify the table name if it's not the plural form of the model name
    //

    public function products()
    {
        return $this->hasMany('App\Models\Produk', 'category_id', 'id');
    }
    public function categoriToCard()
    {
        return $this->hasMany('App\Models\Cards', 'category_id', 'id');
    }


}
