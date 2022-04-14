<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function MasterCategory()
    {
        return $this->belongsTo(MasterCategory::class, 'cat_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
