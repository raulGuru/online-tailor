<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = array(
            array(
                'code' => 's',
                'label' => 'Small',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'code' => 'm',
                'label' => 'Medium',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'code' => 'l',
                'label' => 'Large',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'code' => 'xl',
                'label' => 'Extra Large',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'code' => 'xxl',
                'label' => 'Double Extra Large',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'code' => 'xxxl',
                'label' => 'Tripple Extra Large',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        ProductSize::truncate();
        ProductSize::insert($sizes);
    }
}
