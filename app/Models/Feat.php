<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feat extends Model
{
    public function characters(){
        return $this->belongsToMany(Character::class);
    }

    public function backgrounds(){
        return $this->hasMany(Background::class);
    }
}
