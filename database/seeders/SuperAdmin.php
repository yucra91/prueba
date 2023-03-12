<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role =Role::where('name','superAdmin')->first();
        // $user =new User();
        // $user->email="superAdmin@gmail.com";
        // $user->password=bcrypt('123456');
        // $user->save();
        // $token = $user->createToken('auth_token')->plainTextToken;
      
        // $user->assignRole('superAdmin');

       $per = new Persona();
       $per->first_name = "superAdmin";
       $per->last_name  =  "admin";
       $per->ci  ="123456";
       $per->cellphone  =   "654321";
        $per->save();
        $user =new User();
        $user->email="superAdmin@gmail.com";
        $user->password=bcrypt('123456');
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remenber_token =$token;
        $user->assignRole('superAdmin');
        
        $admin = new SuperAdmin();
        return new SuperAdmin($admin);
    }
}
