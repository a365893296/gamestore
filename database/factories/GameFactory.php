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
        'image' => 'images/脸黑先生.jpg',
        'background_image' => 'images/脸黑先生.jpg',
        'images' =>'["images\/63ca3327ada0475acd5c1e1d83ef76b6.jpg","images\/\u8138\u9ed1\u5148\u751f2.jpg","images\/\u8138\u9ed1\u5148\u751f3.jpg"]',
        'rate' => random_int(1,5) ,
    ];
});
