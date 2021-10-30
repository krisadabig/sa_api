<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Po;
use App\Models\PoLine;
use App\Models\SaleOrder;
use App\Models\SaleOrderLine;
use Faker\Factory;
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
        //
        $items = Item::get();

        $faker = Factory::create();

        for ($i = 0; $i < 15; $i++) {
            # code...
            $customer = $faker->randomElement(Customer::all());
            $code = $faker->regexify('S[0-9]{7}');
            SaleOrder::create([
                'code' => $code,
                'customer_id' => $customer->id,
                'status' => $faker->randomElement(["WaitPay", "Complete"]),
                'total_price' => 0
            ]);

            $color = $faker->randomElement(Item::all());
            $so = SaleOrder::where('code', $code)->first();

            if ($so->status === "Complete") {
                $so->complete_date = $so->created_at;
                $so->save();
            }

            $soLine = new SaleOrderLine();
            $soLine->sale_order_code = $so->code;
            $soLine->color_code = $color->code;
            $soLine->quantity = $faker->regexify('[1-9][0-9]{0,1}');
            $soLine->save();
            $so->total_price += $soLine->quantity * $color->price;
            $so->save();

            $color = $faker->randomElement(Item::all());

            $soLine = new SaleOrderLine();
            $soLine->sale_order_code = $so->code;
            $soLine->color_code = $color->code;
            $soLine->quantity = $faker->regexify('[1-9][0-9]{0,1}');
            $soLine->save();

            $so->total_price += $soLine->quantity * $color->price;
            $so->save();
        }
        $so = new SaleOrder();
        $so->code = "S1";
        $so->customer_id = 1;
        $so->status = "WaitPay";
        $so->total_price = 30000;
        $so->save();

        $soLine = new SaleOrderLine();
        $soLine->sale_order_code = "S1";
        $soLine->color_code = $items[3]->code;
        $soLine->quantity = 30;
        $soLine->save();

        $so = new SaleOrder();
        $so->code = "S2";
        $so->customer_id = 2;
        $so->status = "Complete";
        $so->total_price = 8600;
        $so->save();

        $soLine = new SaleOrderLine();
        $soLine->sale_order_code = "S2";
        $soLine->color_code = $items[4]->code;
        $soLine->quantity = 10;
        $soLine->save();
    }
}
