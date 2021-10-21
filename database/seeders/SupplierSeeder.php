<?php

namespace Database\Seeders;

use App\Models\Supplier;
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
        $supplier = new Supplier();
        $supplier->id = 1;
        $supplier->name = "JobJab Company";
        $supplier->phone_no = "02xxxxxxx";
        $supplier->save();

        $supplier = new Supplier();
        $supplier->id = 2;
        $supplier->name = "อีคิวก็ไม่เท่าไหร่";
        $supplier->phone_no = "09xxxxxxxx";
        $supplier->save();
    }
}
