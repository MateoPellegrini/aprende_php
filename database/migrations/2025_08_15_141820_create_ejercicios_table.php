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
        Schema::create('ejercicios', function (Blueprint $t) {
            $t->id();
            $t->foreignId('leccion_id')->constrained('lecciones');
            $t->integer('orden')->default(1);
            $t->string('titulo');
            $t->text('descripcion')->nullable();
            $t->text('consigna');
            $t->enum('tipo_validacion',['texto','patron'])->default('texto');
            $t->text('respuesta_esperada');
            $t->boolean('estado')->default(true);
            $t->softDeletes();
            $t->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios');
    }
};
