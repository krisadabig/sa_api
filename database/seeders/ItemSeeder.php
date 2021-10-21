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
//        $faker = Factory::create();
//        for ($i = 0; $i < 5; $i++) {
//            $item = Item::create([
//                'name' => $faker->regexify('[A-Z]{2}[0-9]{3}'),
//                'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 500, $max = 10000),
//                'quantity' => $faker->numberBetween($min = 30, $max = 100),
//                'min_quantity' => $faker->numberBetween($min = 5, $max = 20)
//            ]);
//        }
        $item = new Item();
        $item->code = "OSP 900";
        $item->price = 1100.00;
        $item->amount = 200;
        $item->min_amount = 30;
        $item->save();

        $item = new Item();
        $item->code = "OSP 311";
        $item->price = 900.00;
        $item->amount = 120;
        $item->min_amount = 10;
        $item->save();

        $item = new Item();
        $item->code = "OSP 213";
        $item->price = 700.00;
        $item->amount = 70;
        $item->min_amount = 60;
        $item->save();

        $item = new Item();
        $item->code = "OSP 730";
        $item->price = 1000.00;
        $item->amount = 170;
        $item->min_amount = 50;
        $item->save();

        $item = new Item();
        $item->code = "OSP 100";
        $item->price = 860.00;
        $item->amount = 20;
        $item->min_amount = 40;
        $item->save();
    }
}
