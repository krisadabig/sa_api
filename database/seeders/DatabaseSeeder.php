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
        $this->call(CustomerSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(POSeeder::class);
        $this->call(SaleOrderSeeder::class);
    }
}
