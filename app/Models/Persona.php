<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';

    protected $fillable = [
        'first_name',
        'last_name',
        'ci',
        'cellphone'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'persona_id','id');
    }
}
