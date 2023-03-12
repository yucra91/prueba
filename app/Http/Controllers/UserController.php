<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function createUser(UserRequest $request)
    {
        $user =new User();
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        
        $user->save();
        $token = $user->createToken('auth_token');
        $user->assignRole('studend');
    }
    
    // public function perfil()
    
    // {
       
    //     return response()->json(['user'=> auth()->user()]);
    // }

    public function user()
    {
        // return response()->json(['user'=> auth()->user()]);

        try{
            return response()->json([
                'success'=>true,
                'user'=>auth()->user()]);
                
            }catch(Exception $e){
                return response()->json([
                    'success'=>false,
                'message'=>$e->getMessage()
                ],500);
            }
        
    }
}
