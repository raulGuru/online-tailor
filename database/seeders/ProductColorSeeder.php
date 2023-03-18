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
                'name' => 'White',
                'code' => '#FFFFFF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Black',
                'code' => '#000000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Grey',
                'code' => '#808080',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Blue',
                'code' => '#0000ff',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Light Blue',
                'code' => '#add8e6',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Green',
                'code' => '#008000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Light Green',
                'code' => '#90ee90',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Red',
                'code' => '#f00000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Pink',
                'code' => '#ffc0cb',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Purple',
                'code' => '#800080',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Orange',
                'code' => '#ffa500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Brown',
                'code' => '#a52a2a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Yellow',
                'code' => '#ffff00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),            
        );

        ProductColor::truncate();
        ProductColor::insert($colors);
    }
}
