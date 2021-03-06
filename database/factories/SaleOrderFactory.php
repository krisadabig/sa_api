<?php

namespace Database\Factories;

use App\Models\SaleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'code' => $this->faker->unique()->numerify('########'),
            'customer_id' => 1,
            'status' => 'WaitCreateBill',
            'total_price' => $this->faker->numberBetween(1000, 200000),

        ];
    }
}
