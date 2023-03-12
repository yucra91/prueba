<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Spatie\Permission\Traits\HasRoles;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;



use function PHPUnit\Framework\returnSelf;

// use App\Http\Requests\UserRequest;

// use App\Models\User;

class AutenticarController extends Controller
{
    public function login(Request $request)
    {
        
            $user =User::with('roles')->where('email', $request->email)->first();
            //  return $user;

            // $roles=$user->roles[0]->name;
            // $gmail=$user->gmail;
            // return $roles;

            if(isset($user)){
                if(Hash::check($request->password,$user->password)){
                    $token= $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        'success'=>true,
                        "token"=>$token,
                        'user'=>$user
                    ]);
                }

                return response()->json([
                    'success'=>false,
                    'message'=>'Contraseña incorrecta'
                ]);
            }
       
            return response()->json([
                'success'=>false, 
                'message'=>'gmail no existe'
            ],500);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message ' => 'Successfully logged out'
        ]) ;
    }

       
  

}
