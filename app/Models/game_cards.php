<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class game_cards extends Model
{

	protected $table = "game_cards";
    
    protected $fillable = [
        'name', 'description', 'user_id', 'sale_id'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function sales(){
        return $this->belongsTo('App\Models\sales');
    }

    public function collections(){
        return $this->belongsToMany('App\Models\collections');
    }
}
