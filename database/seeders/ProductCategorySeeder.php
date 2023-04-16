<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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
                'master_cat_id' => 1,
                'name' => 'Fabric',
                'creator' => 1,
                'action' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        );
        Schema::disableForeignKeyConstraints();
        ProductCategory::truncate();
        Schema::enableForeignKeyConstraints();
        ProductCategory::insert($types);            
    }
}
