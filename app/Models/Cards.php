<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;
    protected $table ='cards';

    public function cardToBrand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function cardToCategory(){
        return $this->belongsTo('App\Models\Categori', 'category_id', 'id');
    }
    public function cardToGame(){
        return $this->belongsTo('App\Models\Game', 'game_id', 'id');
    }
}
