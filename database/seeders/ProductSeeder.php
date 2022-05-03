<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            array(
                'creator' => 1,
                'title' => 'On Cloud Nine Pillow',
                'slug' => 'on-cloud-nine-pillow',
                'sku' => "XYZ-PQR-ABC",
                'cat_id' => 1,
                'type_id' => 1,
                'color_id' => 1,
                'size' => 2000,
                'price' => 100,
                'description' => "Sociosqu facilisis duis ...",
                'width' => "44 Inches | 112 Cms.",
                'weight' => "Approx. 110 grams per meter",
                'disclaimer' => "Slight difference in color from visible product image is possible.",
                'quality' => "Viscose",
                'mfg_by' => "Fabcurate",
                'note' => "All the taxes and duties will be borne by customers for international orders.",
                'additional_details' => 'This is an example to demonstrate how product variations can be used to allow customers to select options e.g. size/colour when buying products.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        Product::truncate();
        Product::insert($products);
    }
}
