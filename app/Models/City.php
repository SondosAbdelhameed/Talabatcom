<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class City extends Model
{
    use HasFactory;

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function country()
{
    return $this->belongsTo(Country::class, 'country_id');
}

}
