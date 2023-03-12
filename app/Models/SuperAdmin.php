<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;
    protected $table = 'super_admins';
    protected $fillable = [
     
        'persona_id',
        'user_id',
    ];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
