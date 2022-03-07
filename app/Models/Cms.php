<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class Cms extends Model
{
    use HasFactory;

    public function getContentAttribute($value) {
        return $this->{'content_' . App::getLocale()};
    }
}
