<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('progetti', function (Blueprint $table) {
            if (!Schema::hasColumn('progetti', 'importo_lavori')) {
                $table->unsignedBigInteger('importo_lavori')->nullable()->after('anno');
            }
        });
    }

    public function down(): void
    {
        Schema::table('progetti', function (Blueprint $table) {
            if (Schema::hasColumn('progetti', 'importo_lavori')) {
                $table->dropColumn('importo_lavori');
            }
        });
    }
};
