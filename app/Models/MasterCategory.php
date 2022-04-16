<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }
}
