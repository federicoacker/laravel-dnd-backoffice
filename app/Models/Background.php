<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    public function characters(){
        return $this->hasMany(Character::class);
    }
    public function feat(){
        return $this->belongsTo(Feat::class);
    }

    public function proficiencies(){
        return $this->belongsToMany(Proficiency::class);
    }
}
