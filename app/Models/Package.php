<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Package extends Model
{
    use HasFactory;

    public function getTitleAttribute($value) {
        return $this->{'title_' . App::getLocale()};
    }

    public function getdescriptionAttribute($value) {
        return $this->{'description_' . App::getLocale()};
    }

    public function restaurant()
{
    return $this->belongsTo(Restaurant::class, 'restaurant_id');
}

}
