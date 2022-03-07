<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use DB;

class Restaurant extends Model
{
    use HasFactory;

    protected $appends = [
        'name',
        'review_avg',
    ];

    protected $casts = [
        'longitude'=>'decimal:8',
        'latitude'=>'decimal:8',
    ];

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function area(){
        return $this->belongsTo(Area::class, 'area_id')->with('city');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class, 'restaurant_categories');
    }

    public function images(){
        return $this->hasMany(RestaurantImage::class, 'restaurant_id');
    }

    public function menu(){
        return $this->hasMany(Menu::class, 'restaurant_id')->with('category')->orderBy('category_id');
    }

    public function reviews(){
        return $this->hasManyThrough(Review::class,Order::class);
    }

    public function getReviewAvgAttribute($value) {
        return round($this->reviews()->avg(DB::raw('rate')),2);
    }

    public function getLogoAttribute($value){
         return url('data/restaurant/logo/'.$value);
    }

    public function menu_group(){
        return $this->belongsToMany(MenuCategory::class, 'menus','restaurant_id','category_id')
        ->with('menu');
    }

}
