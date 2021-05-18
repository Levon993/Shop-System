<?php

use Illuminate\Database\Seeder;
use database\seeds\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
        $this->call(CategoriesSeeder::class);
      $this->call(BrandsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(OrdersSeeder::class);
       $this->call(AdminOrderProductsSeeder::class);
      $this->call(RoelSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserRoleSeed::class);
        $this->call(OrderTableSeeder::class);
    }
}
