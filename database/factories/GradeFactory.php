<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Grade::class, function (Faker $faker) {
    $user_count =  \App\User::all()->count();
    $game_count = \App\Models\Game::all()->count() ;

    return [
        'user_id' => random_int(1 , $user_count) ,
        'game_id' => random_int(1 , $game_count),
        'grade' => random_int(1,5) ,
    ];
});
