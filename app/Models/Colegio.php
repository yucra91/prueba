<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre_colegio',
        'direccion',
        'telefono',
        'celular',
        'imagen'
    ];
    public function estudiante(){
      return $this->hasMany(Student::class) ; 
    }
}
