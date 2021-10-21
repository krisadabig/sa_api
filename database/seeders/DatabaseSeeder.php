<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
<<<<<<< HEAD
=======
        $this->call(CustomerSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(POSeeder::class);
>>>>>>> 886542e5d1d166e079d4b9766ca11e2b1ea12cd3
        $this->call(SaleOrderSeeder::class);
    }
}
