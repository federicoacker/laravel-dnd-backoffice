<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function professions(){
        return $this->belongsToMany(Profession::class);
    }
    public function species(){
        return $this->belongsToMany(Species::class);
    }
}
