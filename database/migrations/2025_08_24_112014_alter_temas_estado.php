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
    Schema::table('temas', function (Blueprint $t) {
        $t->dropColumn('estado');
        $t->enum('estado', ['activo', 'desactivado', 'borrado'])
          ->default('activo')
          ->after('descripcion');
        $t->dropSoftDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temas', function (Blueprint $t) {
            $t->dropColumn('estado');
            $t->boolean('estado')->default(true)->after('descripcion');
            $t->softDeletes();
        });
    }
};
