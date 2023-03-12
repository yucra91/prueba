<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('colegio_id')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas')
                    ->constrained()
                    ->onUpdate('cascade') 
                    ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                    ->constrained()
                    ->onUpdate('cascade') 
                    ->onDelete('cascade');
            $table->foreign('colegio_id')->references('id')->on('colegios')
                    ->constrained();
                    // ->onUpdate('cascade') 
                    // ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};