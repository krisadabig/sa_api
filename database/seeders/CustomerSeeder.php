<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
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
            $customer = Customer::create([
                'name' => $faker->name(),
                'address' => $faker->address(),
                'phone_no' => $faker->regexify('0[89][0-9]{7}')
            ]);
        }

        $customer = new Customer();
        $customer->name = "Jobjob";
        $customer->address = "ปลาวาฬ";
        $customer->phone_no = "08xxxxxxxx";
        $customer->save();

        $customer = new Customer();
        $customer->name = "Aui";
        $customer->address = "TI5";
        $customer->phone_no = "08xxxx2488";
        $customer->save();
    }
}
