<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
     
        'persona_id',
        'user_id',
        'colegio_id'
    ];

    
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id','id');
    }
    public function users()
    {
        return $this->belongsTo(Persona::class, 'user_id','id');
    }

    public function colegio(){
        return $this->belongsToMany(Colegio::class) ; 
      }
}
