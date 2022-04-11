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
                'type' => 'men',
                'cat_id' => 1,
                'color_id' => 1,
                'size_id' => 1,
                'type_id' => 1,
                'sleeve_id' => 1,
                'title' => 'On Cloud Nine Pillow',
                'slug' => 'On-cloud-nine-pillow',
                'description' => "Sociosqu facilisis duis ...",
                'additional_details' => 'This is an example to demonstrate how product variations can be used to allow customers to select options e.g. size/colour when buying products.',
                'sku' => "XYZ-PQR-ABC",
                'price' => 100,
                'images' => json_encode([1, 2, 3, 4], true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        Product::truncate();
        Product::insert($products);
    }
}
