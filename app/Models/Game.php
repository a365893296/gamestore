<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = "games";

    protected $fillable = [
        'name','category_id',
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
