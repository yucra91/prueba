<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'student']);
        $role = Role::create(['name' => 'superAdmin']);
        $role = Role::create(['name' => 'staff']);

    }

    public function down(){
    
    }
};
