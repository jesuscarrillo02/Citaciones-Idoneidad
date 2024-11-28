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
        Schema::create('tb_institucion', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_inst', 50);
            $table->string('Direccion', 50);
            $table->string('Comuna', 50);
            $table->unsignedBigInteger('ID_Institucion_ayu');
            $table->timestamps();

            $table->foreign('ID_Institucion_ayu')->references('id')->on('tb_tipo_institucion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_institucion');
    }
};
