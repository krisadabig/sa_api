<?php

namespace Database\Seeders;

use App\Models\Item;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $item = Item::create([
                'name' => $faker->regexify('[A-Z]{2}[0-9]{3}'),
                'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 500, $max = 10000),
                'quantity' => $faker->numberBetween($min = 30, $max = 100),
                'min_quantity' => $faker->numberBetween($min = 5, $max = 20)
            ]);
        }
    }
}
