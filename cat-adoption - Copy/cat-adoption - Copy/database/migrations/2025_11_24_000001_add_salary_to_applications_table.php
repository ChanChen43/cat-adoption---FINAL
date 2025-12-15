<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL to check for column existence
        $columnExists = DB::select("SELECT COUNT(*) AS count FROM user_tab_columns WHERE table_name = 'APPLICATIONS' AND column_name = 'SALARY'");

        if (empty($columnExists) || $columnExists[0]->count == 0) {
            Schema::table('applications', function (Blueprint $table) {
                $table->decimal('salary', 10, 2)->nullable()->after('fee');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'salary')) {
                $table->dropColumn('salary');
            }
        });
    }
};
