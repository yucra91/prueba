<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\Persona;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     

    public function index(Request $request)
    {
        if($request->name){

            $name_person= Admin::from('admins as a')
            ->join('personas as p','p.id','a.persona_id')
            ->where('p.first_name','like',"%".$request->name."%")
            ->select('a.*')
            ->with('users','personas')->get();
            
            return response()->json([
                'ok'=>true,
                'Admin'=> $name_person
            ]);
        }

        return response()->json([
            'ok'=>true,
            'Admin'=> Admin::with('users','personas')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'ci'=>'required',
            'cellphone'=>'required',
        ]);

       $per = new Persona();
       $per->first_name =   $request->first_name;
       $per->last_name  =   $request->last_name;
       $per->ci  =   $request->ci;
       $per->cellphone  =   $request->cellphone;
        $per->save();

        $request->validate([
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
        
        $user =new User();
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remenber_token =$token;
        $user->assignRole('admin');
        
        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->persona_id = $per->id;
       
         $admin->save();
        return new AdminResource($admin);
    }

    public function show(Admin $admin)
    {
        return new AdminResource( Admin::with('users','personas')
        ->where('id',$admin->id)->get());

    }
    public function update($id,Request $admin)
    {   
   
        $admins_person = Admin::findOrFail($id)
                        ->personas()->get()->first();
        $update_persona = Persona::findOrFail($admins_person->id);
        $update_persona->first_name = $admin->first_name;
        $update_persona->last_name = $admin->last_name;
        $update_persona->ci = $admin->ci;
        $update_persona->cellphone = $admin->cellphone;
        $update_persona->save();
        

        $admins_users = Admin::findOrFail($id)                     
                        ->users()->get()->first();
        $update_user = User::findOrFail($admins_users->id);

        $update_user->email = $admin->email;

        if($admin->password!=null){           
            $update_user->password = bcrypt($admin->password);
           $update_user->save();

            return $update_user;
        }
        $update_user->save();
        
    }

    public function destroy(Admin $admin)
    {
        $admin ->delete();
        return new AdminResource($admin);
    }
}
