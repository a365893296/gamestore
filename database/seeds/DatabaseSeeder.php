<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(CategoriesSeeder::class);
//        $this->call(AdminUsersTableSeeder::class);
        $this->call(RateSeeder::class) ;
        $this->call(PurchaseHistorySeeder::class);
    }
}
