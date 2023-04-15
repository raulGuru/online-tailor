<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $table = 'product_sub_categories';
    protected $fillable = [
        'creator'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function post_count()
    {
        return $this->hasMany(Product::class, 'subtype_id');
    }


}
