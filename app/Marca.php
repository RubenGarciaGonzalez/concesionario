<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Coche;
class Marca extends Model
{
    protected $fillable=['nombre', 'logo', 'pais'];
    //vamos con las relaciones es 1:N es decir d una marca
    //tendremos muchos coches, en marcas pondremos
    public function coches(){
        return $this->hasMany(Coche::class);
    }
}
