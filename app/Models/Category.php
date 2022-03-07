<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
class Category extends Model
{
    use HasFactory;

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function getIconAttribute($value){
         return url('data/category/'.$value);
    }
    public function restaurant()
{
    return $this->belongsToMany(Restaurant::class, 'restaurant_categories');
}
}
