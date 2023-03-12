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
        Schema::create('col_actidads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colegio_id');
            $table->unsignedBigInteger('actividad_id');
            $table->foreign('colegio_id')->references('id')->on('colegios')
            ->constrained()
            ->onUpdate('cascade') 
            ->onDelete('cascade');
            $table->foreign('actividad_id')->references('id')->on('actividades')
            ->constrained()
            ->onUpdate('cascade') 
            ->onDelete('cascade');
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
        Schema::dropIfExists('col_actidads');
    }
};
