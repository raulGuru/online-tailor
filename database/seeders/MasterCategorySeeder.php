<?php

namespace Database\Seeders;

use App\Models\MasterCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array(
                'title' => 'Men',
                'slug' => 'men',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Women',
                'slug' => 'women',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        MasterCategory::truncate();
        MasterCategory::insert($categories);
    }
}
