<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id', 'id');
    }
    public function categori(){
        return $this->belongsTo('App\Models\categori', 'category_id', 'id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'product_id', 'id');
    }
}
