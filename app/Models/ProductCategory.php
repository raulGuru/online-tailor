<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'creator',
        'master_cat_id',
        'action',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function masterCategory()
    {
        return $this->belongsTo(MasterCategory::class, 'master_cat_id');
    }

    public function posts()
    {
        $where = array();
        if(request()->gender && request()->gender === 'male') {
            $where = array('cat_id' => 1);
        } else if(request()->gender && request()->gender === 'women') {
            $where = array('cat_id' => 2);
        }
        return $this->hasMany(Product::class, 'type_id')->where($where);
    }

    public function subCategories()
    {
        return $this->hasMany(ProductSubCategory::class, 'product_category_id');
    }
}
