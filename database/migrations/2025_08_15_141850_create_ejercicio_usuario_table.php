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
        Schema::create('ejercicio_usuario', function (Blueprint $t) {
            $t->foreignId('user_id')->constrained('users');
            $t->foreignId('ejercicio_id')->constrained('ejercicios');
            $t->enum('estado',['pendiente','resuelto'])->default('pendiente');
            $t->text('respuesta_usuario')->nullable();
            $t->boolean('correcto')->default(false);
            $t->unsignedInteger('intentos')->default(0);
            $t->timestamps();
            $t->primary(['user_id','ejercicio_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_usuario');
    }
};
