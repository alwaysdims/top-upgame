<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands'; // Specify the table name if it's not the plural form of the model name

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }
    public function game()
    {
        return $this->hasMany('App\Models\Game', 'brand_id', 'id');
    }
    public function brandToCard(){
        return $this->hasMany('App\Models\Cards', 'brand_id', 'id');
    }
}
