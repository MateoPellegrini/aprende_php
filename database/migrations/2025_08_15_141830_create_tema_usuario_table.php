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
        Schema::create('tema_usuario', function (Blueprint $t) {
            $t->foreignId('user_id')->constrained('users');
            $t->foreignId('tema_id')->constrained('temas');
            $t->enum('estado',['pendiente','en_curso','completado'])->default('pendiente');
            $t->unsignedTinyInteger('porcentaje')->default(0);
            $t->timestamps();
            $t->primary(['user_id','tema_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_usuario');
    }
};
