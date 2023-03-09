<?php

namespace Database\Seeders;

use App\Models\ProductSubCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSubCategorySeeder extends Seeder
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
                'product_category_id' => 1,
                'name' => 'Subtype1',
                'creator' => 1,
                'action' => 'active',
                'created_at' => Carbon::now(),
            ),
            array(
                'id' => 2,
                'product_category_id' => 2,
                'name' => 'Subtype2',
                'creator' => 1,
                'action' => 'active',
                'created_at' => Carbon::now(),
            ),
        );
        ProductSubCategory::truncate();
        ProductSubCategory::insert($types); 
    }
}
