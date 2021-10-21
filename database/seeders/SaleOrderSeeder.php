<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\SaleOrder;
use App\Models\SaleOrderLine;
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
        $items = Item::get();

        $so = new SaleOrder();
        $so->code = "S1";
        $so->customer_id = 1;
        $so->status = "WaitPay";
        $so->total_price = 30000;
        $so->save();

        $soLine = new SaleOrderLine();
        $soLine->id = 1;
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
        $soLine->id = 2;
        $soLine->sale_order_code = "S2";
        $soLine->color_code = $items[4]->code;
        $soLine->quantity = 10;
        $soLine->save();


    }
}
