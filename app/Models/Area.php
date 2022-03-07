<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Area extends Model
{
    use HasFactory;

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

}
