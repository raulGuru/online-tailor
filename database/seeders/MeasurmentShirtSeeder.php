<?php

namespace Database\Seeders;

use App\Models\MeasurmentShirt;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeasurmentShirtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shirt = array(
            array(
                'creator' => 1,
                'order_id' => 'o123456',
                'product_type_id' => 1,
                'Length' =>36,
                'shoulder' => 38,
                'full_sleeve_length' => 30,
                'half_sleeve_length' => 15,
                'cuff' => 16,
                'arm' => 24,
                'chest' => 36,
                'waist' => 34,
                'hip' => 34,
                'neck' => 12,
                'pocket' => 15,
                'style_details' => 'Style Details',
                'body_posture_details' => 'Posture Details',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        MeasurmentShirt::truncate();
        MeasurmentShirt::insert($shirt);
    }
}
