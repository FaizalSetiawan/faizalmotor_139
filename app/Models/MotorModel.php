<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorModel extends Model
{
    protected $fillable = ['brand_id', 'name'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
