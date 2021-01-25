<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{

	protected $table = "sales";
    
    protected $fillable = [
        'id', 'quantity', 'price'
    ];

    public function game_card(){
        return $this->hasMany('App\Models\game_cards');
    }
}
