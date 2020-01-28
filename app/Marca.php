<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Coche;

class Marca extends Model
{
    protected $fillable = ['nombre', 'logo', 'pais'];
    //Vamos con las relaciones: es 1:N, es decir, de una marca tendremos muchos coches, por lo que en marcas pondremos:
    public function coches(){
        return $this->hasMany(Coche::class);
    }
}
