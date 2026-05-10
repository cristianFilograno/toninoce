<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progetti', function (Blueprint $table) {
            $table->string('foto_copertina')->nullable()->after('categoria_id');
            $table->json('galleria')->nullable()->after('foto_copertina');
        });
    }

    public function down(): void
    {
        Schema::table('progetti', function (Blueprint $table) {
            $table->dropColumn(['foto_copertina', 'galleria']);
        });
    }
};
