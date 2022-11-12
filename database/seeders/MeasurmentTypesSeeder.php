<?php

namespace Database\Seeders;

use App\Models\MeasurmentTypes;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeasurmentTypesSeeder extends Seeder
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
                'cat_id' => 1,
                'name' => 'Shirt',
                'slug' => 'shirt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'cat_id' => 1,
                'name' => 'Pant / Trouser',
                'slug' => 'pant',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'cat_id' => 1,
                'name' => 'Jacket',
                'slug' => 'jacket',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'cat_id' => 1,
                'name' => 'Blazer',
                'slug' => 'blazer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'cat_id' => 1,
                'name' => 'Kurta',
                'slug' => 'kurta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'cat_id' => 1,
                'name' => 'Pyjama',
                'slug' => 'pyjama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        MeasurmentTypes::truncate();
        MeasurmentTypes::insert($types);
    }
}
