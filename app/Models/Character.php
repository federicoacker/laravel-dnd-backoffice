<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    public function background(){
        return $this->belongsTo(Background::class);
    }
    public function species(){
        return $this->belongsTo(Species::class);
    }
    
    public function profession(){
        return $this->belongsTo(Profession::class);
    }

    public function proficiencies(){
        return $this->belongsToMany(Proficiency::class);
    }

    public function feats(){
        return $this->belongsToMany(Feat::class);
    }
}
