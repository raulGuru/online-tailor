<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = array(
            array(
                'name' => 'Red',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Green',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Blue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        ProductColor::truncate();
        ProductColor::insert($colors);
    }
}
