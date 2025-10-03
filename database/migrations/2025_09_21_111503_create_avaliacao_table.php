<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->decimal('nota', 2, 1);
            $table->text('comentario')->nullable();

            // FK para usuario
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');

            // FK para musica
            $table->unsignedBigInteger('musica_id');
            $table->foreign('musica_id')->references('id')->on('musicas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacao');
    }
};
