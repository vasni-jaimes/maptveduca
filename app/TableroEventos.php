<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableroEventos extends Model
{
    protected $table = "tablero_eventos";

    public function eventos()
    {
    	return $this->hasOne('App\Evento', 'id', 'evento_id');
    }
}
