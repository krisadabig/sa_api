<?php

namespace Database\Seeders;

use App\Models\SaleOrder;
use Illuminate\Database\Seeder;

class SaleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleOrder::factory()->count(500)->create();
        //
    }
}
