<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Po;
use App\Models\PoLine;
use App\Models\Supplier;
use Faker\Factory;
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
        $faker = Factory::create();

        for ($i = 0; $i < 15; $i++) {
            # code...
            $supplier = $faker->randomElement(Supplier::all());
            $code = $faker->regexify('P[0-9]{7}');
            $po = Po::create([
                'code' => $code,
                'supplier_id' => $supplier->id,
                'status' => $faker->randomElement(["Wait", "WaitPay", "Complete"]),
                'total_price' => 0
            ]);

            $color = $faker->randomElement(Item::all());
            $po = Po::where('code', $code)->first();

            $poLine = new PoLine();
            $poLine->po_code = $po->code;
            $poLine->color_code = $color->code;
            $poLine->quantity = $faker->regexify('[1-9][0-9]{1,2}');
            $poLine->price_per_unit = $faker->regexify('[1-9][0-9]{2}');
            $poLine->save();
            if ($po->status === "Wait") {
                $color->no_po_line += 1;
                $color->save();
            }
            $po->total_price = $poLine->price_per_unit * $poLine->quantity;
            $po->save();

            $color = $faker->randomElement(Item::all());

            $poLine = new PoLine();
            $poLine->po_code = $po->code;
            $poLine->color_code = $color->code;
            $poLine->quantity = $faker->regexify('[1-9][0-9]{1,2}');
            $poLine->price_per_unit = $faker->regexify('[1-9][0-9]{2}');
            $poLine->save();
            $po->total_price = $poLine->price_per_unit * $poLine->quantity;
            $po->save();
        }


        $po = new Po();
        $po->code = "P1";
        $po->supplier_id = 1;
        $po->status = "Wait";
        $po->total_price = 19000;
        $po->save();

        $poLine = new PoLine();
        $poLine->po_code = "P1";
        $poLine->color_code = $items[0]->code;
        $poLine->quantity = 20;
        $poLine->price_per_unit = 950;
        $poLine->save();

        $po = new Po();
        $po->code = "P2";
        $po->supplier_id = 2;
        $po->status = "WaitPay";
        $po->total_price = 28000;
        $po->save();

        $poLine = new PoLine();
        $poLine->po_code = "P2";
        $poLine->color_code = $items[1]->code;
        $poLine->quantity = 35;
        $poLine->price_per_unit = 800;
        $poLine->save();

        $po = new Po();
        $po->code = "P3";
        $po->supplier_id = 1;
        $po->status = "Complete";
        $po->total_price = 60000;
        $po->save();

        $poLine = new PoLine();
        $poLine->po_code = "P3";
        $poLine->color_code = $items[2]->code;
        $poLine->quantity = 100;
        $poLine->price_per_unit = 600;
        $poLine->save();
    }
}
