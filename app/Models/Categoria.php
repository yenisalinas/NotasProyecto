<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    //belongsToMany relacion M:N -otra tabla
    //Funcion 1:N entre el modelo actual y el modelo Nota
    // uno-a-muchos.
    public function Notas(){
        return $this->hasMany(Nota::class);
    }

    //relación de pertenencia ("belongs to")
    public function user(){
        return $this->belongsTo(User::class);
    }

    //especificar qué campos pueden ser asignados 
    protected $fillable = ['nombre_categoria', 'user_id'];
}
