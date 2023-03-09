<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
class ProductCategorySeeder extends Seeder
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
                'id' => 1,
                'name' => 'type1',
                'creator' => 1,
                'action' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                'id' => 2,
                'name' => 'type2',
                'creator' => 1,
                'action' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        );
        // ProductCategory::truncate();
        ProductCategory::insert($types);            
    }
}
