<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    use HasFactory;

    public function posts()
    {
        $where = array();
        if(request()->gender && request()->gender === 'male') {
            $where = array('cat_id' => 1);
        } else if(request()->gender && request()->gender === 'women') {
            $where = array('cat_id' => 2);
        }
        return $this->hasMany(Product::class, 'cat_id')->where($where);
    }

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class, 'master_cat_id');
    }
}
