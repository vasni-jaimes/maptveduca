<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = "aulas_publicacion_create";

    public function profesor()
    {
        return $this->hasOne('App\Administrator', 'id', 'profesor_id');
    }
}
