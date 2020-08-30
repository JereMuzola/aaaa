<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable=['nom_institution','type','adresse','province','pseudo','password'];

    public function setPasswordAttributes($password){
        $this->attributes['password']=bcrypt($password);
    }
    public function Etudiants(){
        return $this->hasMany('App\etudiant');
    }

}
