<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = "rates";
    protected $fillable = ['user_id', 'game_id', 'rate'];

    public static  function getRate($user_id , $game_id){
        $rate = Rate::where([
            'user_id' => $user_id,
            'game_id' => $game_id
        ])->first();
        return $rate;
    }
}
