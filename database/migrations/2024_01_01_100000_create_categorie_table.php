<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorie', function (Blueprint $table) {
            $table->id();
            $table->json('nome');        // {"it": "Residenziale", "en": "Residential"}
            $table->string('slug')->unique();
            $table->string('tipo')->default('progetto'); // 'progetto' o 'download'
            $table->integer('ordine')->default(0);
            $table->boolean('attiva')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorie');
    }
};
