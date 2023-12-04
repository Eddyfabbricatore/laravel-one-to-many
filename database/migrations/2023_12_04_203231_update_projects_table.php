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
        Schema::table('projects', function (Blueprint $table) {
            // Creo la colonna della FK
            $table->unsignedBigInteger('technology_id')->nullable()->after('id');

            // Assegno la FK alla colonna creata
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Elinimo la FK
            $table->dropForeign(['technology_id']);

            // Elimino la colonna della FK
            $table->dropColumn('technology_id');
        });
    }
};
