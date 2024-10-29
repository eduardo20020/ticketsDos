<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('etiqueta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('prioridad')->nullable();
            $table->string('grupo')->nullable();
            $table->text('nota')->nullable(); // Usa text para permitir almacenar un texto extenso en 'nota'
        });
    }
    
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'prioridad', 'grupo', 'nota']);
        });
    }
    
};
