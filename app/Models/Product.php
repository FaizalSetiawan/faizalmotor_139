<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function model()
{
    return $this->belongsTo(MotorModel::class, 'motor_model_id');
}
protected $fillable = [
    'motor_model_id',
    'name',
    'image',
    'description',
    'price',
];
}
