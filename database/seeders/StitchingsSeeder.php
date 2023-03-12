<?php

namespace Database\Seeders;

use App\Models\Stitching;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class StitchingsSeeder extends Seeder
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
                'creator' => 1,
                'stitch_name' => 'Grip Pant',
                'slug_name' => 'grip-pant',
                'cost' => '500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Normal Pant',
                'slug_name' => 'normal-pant',
                'cost' => '450',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Fancy Shirt',
                'slug_name' => 'fancy-shirt',
                'cost' => '360',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Normal Shirt',
                'slug_name' => 'normal-shirt',
                'cost' => '300',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Kalidar Kurta',
                'slug_name' => 'kalidar-kurta',
                'cost' => '950',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Kurta',
                'slug_name' => 'kurta',
                'cost' => '850',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Belt Pyjama',
                'slug_name' => 'belt-pyjama',
                'cost' => '400',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Elastic Pyjama',
                'slug_name' => 'elastic-pyjama',
                'cost' => '400',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Blazer',
                'slug_name' => 'blazer',
                'cost' => '3000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Safari',
                'slug_name' => 'safari',
                'cost' => '1000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Sherwani',
                'slug_name' => 'sherwani',
                'cost' => '3500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Jodhpuri',
                'slug_name' => 'jodhpuri',
                'cost' => '3500',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Modi Jacket',
                'slug_name' => 'modi-jacket',
                'cost' => '1000',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'creator' => 1,
                'stitch_name' => 'Nehru Jacket',
                'slug_name' => 'nehru-jacket',
                'cost' => '1150',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );
        Stitching::truncate();
        Stitching::insert($types);
    }
}
