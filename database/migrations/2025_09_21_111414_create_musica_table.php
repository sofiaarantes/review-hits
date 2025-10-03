<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('musicas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->string('album', 150)->nullable();
            $table->integer('ano_lancamento')->nullable();

            // FK para gênero
            $table->unsignedBigInteger('genero_id')->nullable();
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('set null');

            // FK para artista
            $table->unsignedBigInteger('artista_id');
            $table->foreign('artista_id')->references('id')->on('artistas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('musica');
    }
};
