<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('lecciones', 'estado')) {
            Schema::table('lecciones', function (Blueprint $t) {
                $t->boolean('estado')->default(true)->after('descripcion');
                $t->index(['tema_id', 'estado']);
            });

            DB::table('lecciones')->update(['estado' => true]);
        }

        if (Schema::hasColumn('lecciones', 'deleted_at')) {
            Schema::table('lecciones', function (Blueprint $t) {
                $t->dropSoftDeletes();
            });
        }

        Schema::table('lecciones', function (Blueprint $t) {
            try {
                $t->dropForeign('lecciones_tema_id_foreign');
            } catch (\Throwable $e) {}

            $t->foreign('tema_id')
              ->references('id')->on('temas')
              ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('lecciones', function (Blueprint $t) {
            $t->dropIndex(['tema_id', 'estado']);
        });

        Schema::table('lecciones', function (Blueprint $t) {
            try {
                $t->dropForeign('lecciones_tema_id_foreign');
            } catch (\Throwable $e) {}

            $t->foreign('tema_id')
              ->references('id')->on('temas')
              ->cascadeOnDelete();
        });

        if (!Schema::hasColumn('lecciones', 'deleted_at')) {
            Schema::table('lecciones', function (Blueprint $t) {
                $t->softDeletes();
            });
        }

        if (Schema::hasColumn('lecciones', 'estado')) {
            Schema::table('lecciones', function (Blueprint $t) {
                $t->dropColumn('estado');
            });
        }
    }
};
