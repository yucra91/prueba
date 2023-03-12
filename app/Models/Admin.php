<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable = [
     
        'persona_id',
        'user_id',
    ];

    public static function search($query=''){
        if (!$query){
            return self::all();
        }
        return self::where('nombre','like',"%$query%")
        ->orwhere('apllido','like',"$query")
        ->get();
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
