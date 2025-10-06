<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
     // Specify the table name if it's not the plural form of the model name
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brands_id', 'id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }
    public function brandToCard()
    {
        return $this->hasMany('App\Models\Cards', 'game_id', 'id');
    }

}
