<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Po;
use App\Models\PoLine;
use Illuminate\Database\Seeder;

class POSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::get();

        $po = new Po();
        $po->code = "P1";
        $po->status = "Wait";
        $po->total_price = 19000;
        $po->save();

        $poLine = new PoLine();
        $poLine->id = 1;
        $poLine->po_code = $po->code;
        $poLine->color_code = $items[0]->code;
        $poLine->quantity = 20;
        $poLine->price_per_unit = 950;
        $poLine->save();

        $po = new Po();
        $po->code = "P2";
        $po->status = "WaitPay";
        $po->total_price = 28000;
        $po->save();

        $poLine = new PoLine();
        $poLine->id = 2;
        $poLine->po_code = $po->code;
        $poLine->color_code = $items[1]->code;
        $poLine->quantity = 35;
        $poLine->price_per_unit = 800;
        $poLine->save();

        $po = new Po();
        $po->code = "P3";
        $po->status = "Complete";
        $po->total_price = 60000;
        $po->save();

        $poLine = new PoLine();
        $poLine->id = 3;
        $poLine->po_code = $po->code;
        $poLine->color_code = $items[2]->code;
        $poLine->quantity = 100;
        $poLine->price_per_unit = 600;
        $poLine->save();
    }
}
