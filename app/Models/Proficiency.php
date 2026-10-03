<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proficiency extends Model
{
    public function professions(){
        return $this->belongsToMany(Profession::class);
    }
    public function characters(){
        return $this->belongsToMany(Character::class);
    }

    public function backgrounds(){
        return $this->belongsToMany(Background::class);
    }
}
