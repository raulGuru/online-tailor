<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'cat_id');
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function productSleeve()
    {
        return $this->belongsTo(ProductSleeve::class, 'sleeve_id');
    }
}
