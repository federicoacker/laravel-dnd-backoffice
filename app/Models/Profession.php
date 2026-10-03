<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    public function characters(){
        return $this->hasMany(Character::class);
    }
    public function spells(){
        return $this->belongsToMany(Spell::class);
    }

    public function proficiencies(){
        return $this->belongsToMany(Proficiency::class);
    }

    public function features(){
        return $this->belongsToMany(Feature::class);
    }
}
