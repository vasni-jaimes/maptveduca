<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiclosEscolares extends Model
{
    protected $table = "ciclos_escolares";


    public function fechasTrimestres()
    {
        return $this->hasMany('App\CiclosFechas', 'ciclo_id', 'id');
    }

}
