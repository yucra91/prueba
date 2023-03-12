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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombreActividad');
            $table->string('descripcion');
            $table->string('imagen_actividad');
            $table->date('fecha_actividad');
            $table->time('hora_actividad');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('evento_id')->references('id')->on('eventos')
            ->constrained()
            ->onUpdate('cascade') 
            ->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staffs')
            ->constrained()
            ->onUpdate('cascade') 
            ->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')
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
        Schema::dropIfExists('actividads');
    }
};
