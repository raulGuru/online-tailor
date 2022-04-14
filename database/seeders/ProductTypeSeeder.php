<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = array(
            array(
                'name' => 'fabric',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'chiffon',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'cotton',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'crepe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'denim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'lace',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'leather',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'linen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'satin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'silk',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'synthetics',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'velvet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'wool',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        ProductType::truncate();
        ProductType::insert($types);
    }
}
