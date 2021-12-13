<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';

    //relasi dengan tabel movie
    public function movies(){
        return $this->hasMany('App\Models\Movie', 'id', 'movie_id');
    }
}
