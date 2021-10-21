<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        $customer = new Customer();
        $customer->id = 1;
        $customer->name = "Jobjob";
        $customer->address = "ปลาวาฬ";
        $customer->phone_no = "08xxxxxxxx";
        $customer->save();

        $customer = new Customer();
        $customer->id = 2;
        $customer->name = "Aui";
        $customer->address = "TI5";
        $customer->phone_no = "08xxxx2488";
        $customer->save();
    }
}
