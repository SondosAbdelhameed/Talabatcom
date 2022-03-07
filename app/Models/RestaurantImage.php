<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantImage extends Model
{
    use HasFactory;
    protected $table = 'restaurant_images';

    public function getImageAttribute($value){
         return url('data/restaurant/background/'.$value);
    }
}
