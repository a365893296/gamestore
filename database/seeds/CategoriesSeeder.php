<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '射击游戏'],
            ['name' => '动作游戏'],
            ['name' => '益智游戏'],
            ['name' => '休闲游戏'],
            ['name' => '冒险游戏'],
            ['name' => '多人合作'],
            ['name' => '单机游戏'],
            ['name' => '网络游戏'],
        ]);
    }
}
