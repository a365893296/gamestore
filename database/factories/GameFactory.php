<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Game::class, function (Faker $faker) {
    return [
        'name'=> $faker->userName,
        'price' => $faker->randomFloat(2,0 ,100),
        'path'=>"/path/$faker->word",
        'category_id' =>random_int(1,8),
        'description'=>"$faker->text"  ,
        'issue_date'=>$faker->dateTime ,
    ];
});
