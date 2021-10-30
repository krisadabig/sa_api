<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 15; $i++) {
            Supplier::create([
                'name' => $faker->name(),
                'phone_no' => $faker->regexify('0[89][0-9]{7}')
            ]);
        }
        $supplier = new Supplier();
        $supplier->name = "JobJab Company";
        $supplier->phone_no = "02xxxxxxx";
        $supplier->save();

        $supplier = new Supplier();
        $supplier->name = "อีคิวก็ไม่เท่าไหร่";
        $supplier->phone_no = "09xxxxxxxx";
        $supplier->save();
    }
}
