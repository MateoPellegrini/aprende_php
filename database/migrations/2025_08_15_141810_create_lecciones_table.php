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
        Schema::create('lecciones', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tema_id')->constrained('temas');
            $t->integer('orden')->default(1);
            $t->string('titulo');
            $t->text('descripcion')->nullable();
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
        Schema::dropIfExists('leccions');
    }
};
