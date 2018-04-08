<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPurchase extends Model
{
    protected $table = "purchase_history";

    protected $fillable = [
        'game_id', 'user_id', 'cost'
    ];

    public function getPurchased($user_id , $game_id)
    {
        $game =  UserPurchase::find(['user_id' => $user_id , 'game_id' => $game_id]);
        return $game ;
    }

}
