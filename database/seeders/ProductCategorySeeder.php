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
        $categories = array(
            array(
                'title' => 'Sample Product',
                'slug' => 'sample-product',
                'description' => "This product is to provide an example of how a product should be structured, and what content should be presented and where. This description is for a concise overview of the product, try to keep it short.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Sample Standard Product Variations',
                'slug' => 'sample-standard-product-variations',
                'description' => "This is an example to demonstrate how product variations can be used to allow customers to select options e.g. size/colour when buying products.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Sample Product with Questionnaire',
                'slug' => 'sample-product-with-questionnaire',
                'description' => "This product is to provide an example of how a product can have a questionnaire to request more information from a customer. This product requires the customer to answer a questionnaire to provide the supplier with information.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        ProductCategory::truncate();
        ProductCategory::insert($categories);
    }
}
