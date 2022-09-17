<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stitching extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator',
        'stitch_name',
        'slug_name',
        'cost'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator');
    }
}
