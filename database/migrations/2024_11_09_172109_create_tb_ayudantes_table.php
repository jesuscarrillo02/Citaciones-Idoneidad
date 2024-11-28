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
        Schema::create('tb_ayudantes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 20); 
            $table->string('Apellido_M', 20); 
            $table->string('Apellido_P', 20); 
            $table->integer('Edad'); 
            $table->string('Sexo', 50)->nullable(); 
            $table->integer('RUT_ayu')->unique();
            $table->integer('DV_ayu');  
            $table->integer('Telefono_ayu');
            $table->string('Correo_ayu', 50); 
            $table->boolean('Estado_ayudante'); 
            $table->unsignedBigInteger('ID_Institucion_ayu'); 
            $table->date('Fecha_registro');
            $table->timestamps();

            $table->foreign('ID_Institucion_ayu')->references('id')->on('tb_institucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ayudantes');
    }
};
