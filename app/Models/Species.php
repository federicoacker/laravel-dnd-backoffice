<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    public function characters(){
        return $this->hasMany(Character::class);
    }
    public function features(){
        return $this->belongsToMany(Feature::class);
    }
}
