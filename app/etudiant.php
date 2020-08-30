<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    protected $fillable=['matricule','sexe','nom','postnom','prenom','date_naissance','lieu_de_naissance','promotion','adresse','institution'];
    public function institution(){
        return $this->belongsTo('App\Institution');
    }


}
