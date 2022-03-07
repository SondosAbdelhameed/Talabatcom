<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Menu extends Model
{
    use HasFactory;

    public function getImageAttribute($value){
         return url('data/restaurant/menu/'.$value);
    }

    public function getIngredientsAttribute($value) {
        return $this->{'ingredients_' . App::getLocale()};
    }

    public function getItemAttribute($value) {
        return $this->{'item_' . App::getLocale()};
    }

    public function category()
{
    return $this->belongsTo(MenuCategory::class, 'category_id');
}

    public function restaurant()
{
    return $this->belongsTo(Restaurant::class, 'restaurant_id');
}

}
