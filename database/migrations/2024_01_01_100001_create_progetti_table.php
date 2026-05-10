<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progetti', function (Blueprint $table) {
            $table->id();
            $table->json('titolo');
            $table->json('descrizione');
            $table->json('luogo')->nullable();
            $table->string('anno')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('categoria_id')->nullable()->constrained('categorie')->nullOnDelete();
            $table->string('foto_copertina')->nullable();      // path pubblico copertina
            $table->json('galleria')->nullable();              // array di path immagini
            $table->boolean('pubblicato')->default(false);
            $table->integer('ordine')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progetti');
    }
};
