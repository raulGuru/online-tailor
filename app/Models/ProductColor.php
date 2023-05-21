<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    public function post_count()
    {
        $where = array();
        if(request()->gender && request()->gender === 'male') {
            $where = array('cat_id' => 1);
        } else if(request()->gender && request()->gender === 'women') {
            $where = array('cat_id' => 2);
        }
        return $this->hasMany(Product::class, 'color_id')->where($where);
    }
}
