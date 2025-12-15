<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Check if the column exists before adding it
        if (!Schema::hasColumn('applications', 'salary')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->integer('salary')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('salary');
        });
    }
};
