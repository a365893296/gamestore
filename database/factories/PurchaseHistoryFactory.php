<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\UserPurchase::class, function (Faker $faker) {
//    $user_count =  \App\User::all()->count();
//    $game_count = \App\Models\Game::all()->count() ;

    $user_count = 100;
    $game_count = 100;

    return [
        'user_id' => random_int(1 , $user_count) ,
        'game_id' => random_int(1 , $game_count),
        'cost' => rand(1,100),
    ];

});
