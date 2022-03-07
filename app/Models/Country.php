<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Country extends Model
{
    use HasFactory;

    public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }
}
