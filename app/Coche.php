<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Coche extends Model
{
    protected $fillable = ['matricula', 'modelo', 'color', 'tipo', 'klms', 'pvp','foto','marca_id'];
    //Un coche tendrá una única marca en la relación 1:N marcas coches
    public function marca(){
        return $this->belongsTo(Marca::class)
        ->withDefault(['nombre'=>'Sin Marca']);
    }

    //Scopes
    public function scopeMarca_id($query, $v){
        if ($v=='%') {
            return $query->where('marca_id','like', $v)
                ->orWhereNull('marca_id');
        }else{
            return $query->where('marca_id', "$v");
        }
    }
}
