<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
class MenuCategory extends Model
{
    use HasFactory;

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function menu(){
        return $this->hasMany(Menu::class, 'category_id');
    }

}
