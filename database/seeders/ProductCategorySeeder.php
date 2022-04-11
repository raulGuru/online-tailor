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
                'title' => 'Denium',
                'slug' => 'denium',
                'description' => "Denim is a rugged, sturdy, twill weave woven, 100% cotton fabric.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Digital Printed',
                'slug' => 'digital-printed',
                'description' => "Digital printing on fabric is a new and innovative process that involves printing a design, a pattern or an image directly from the computer onto the desired media by way of a large format digital printing machine, aka an ink-jet printer.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Viscose',
                'slug' => 'viscose',
                'description' => "Viscose is a semi-synthetic type of rayon fabric made from wood pulp that is used as a silk substitute, as it has a similar drape and smooth feel to the luxury material. The term “viscose” refers specifically to the solution of wood pulp that is turned into the fabric.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Embroidered',
                'slug' => 'embroidered',
                'description' => "Aida cloth (sometimes called Java canvas) is an open, even-weave fabric traditionally used for cross-stitch embroidery. This cotton fabric has a natural mesh that facilitates cross-stitching and enough natural stiffness that the crafter does not need to use an embroidery hoop.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Dyed',
                'slug' => 'dyed',
                'description' => "Fabric Dyeing is the process of adding color to fabric with dyes. There are many techniques for the amateur dyer, from simple grocery store brands of dye to the more sophisticated Procion Fiber Reactive Dye process. Hand dyed fabrics have a depth and richness of color that commercial fabrics often lack.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Organza',
                'slug' => 'organza',
                'description' => "Organza is a lightweight, sheer, plain weave fabric, originally made from silk. Today, many contemporary organzas are made from synthetic materials such as polyester and nylon, providing consumers with an ever greater affordable, versatile and durable choice of fabrics.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Silk',
                'slug' => 'silk',
                'description' => "The strongest natural protein fibre composed mainly of Fibroin, silk is a shimmering textile known for its satin texture and famous for being a luxurious fabric. The most common silk is produced from silkworms, small creatures which mostly live on mulberry leaves.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'title' => 'Taffeta',
                'slug' => 'taffeta',
                'description' => "Taffeta is the ultimate fabric for special occasions, forming iconic ball gowns and evening wear used frequently by iconic designers like Coco Chanel and Christian Dior. The crisp, shiny fabric, made from silk, polyester, or nylon, creates beautiful silhouettes and is considered an ideal fabrics for creating high fashion looks.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        ProductCategory::truncate();
        ProductCategory::insert($categories);
    }
}
