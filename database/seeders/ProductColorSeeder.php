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
                'name' => 'Blue',
                'code' => '#0000ff',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Gray',
                'code' => '#808080',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Gold',
                'code' => '#ffd700',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Red',
                'code' => '#f00000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )            
        );

        ProductColor::truncate();
        ProductColor::insert($colors);
    }
}
