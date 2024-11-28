<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_citaciones', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha_citacion');
            $table->string('Estado_citacion', 20);
            $table->date('fecha_de_registro');
            $table->unsignedBigInteger('ID_Usuario_encargado');
            $table->unsignedBigInteger('ID_institucion_asociada');
            $table->unsignedBigInteger('ID_Ayudante_citado');

            //Claves foraneas
            $table->foreign('ID_Usuario_encargado')->references('id')->on('users');
            $table->foreign('ID_institucion_asociada')->references('id')->on('tb_institucion');
            $table->foreign('ID_Ayudante_citado')->references('id')->on('tb_ayudantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_citaciones');
    }
};
