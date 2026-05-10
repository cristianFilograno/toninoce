<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->json('titolo');         // {"it": "Capitolato 2024", "en": "Specification 2024"}
            $table->json('descrizione')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained('categorie')->nullOnDelete();
            $table->string('file_path');    // percorso del file caricato
            $table->string('file_nome');    // nome originale del file
            $table->string('file_tipo');    // pdf, docx, xlsx, ecc.
            $table->unsignedBigInteger('file_dimensione')->nullable(); // in bytes
            $table->boolean('pubblico')->default(true); // visibile o richiede login
            $table->integer('ordine')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
