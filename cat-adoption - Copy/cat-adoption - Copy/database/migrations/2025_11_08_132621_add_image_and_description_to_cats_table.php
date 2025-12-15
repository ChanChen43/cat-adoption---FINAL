<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageAndDescriptionToCatsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            if (!Schema::hasColumn('cats', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('cats', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn(['image', 'description']);
        });
    }
}
