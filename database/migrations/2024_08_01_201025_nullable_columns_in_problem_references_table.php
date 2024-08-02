<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('problem_references', function (Blueprint $table) {
            $table->longText('reference_title')->nullable()->change();
            $table->longText('reference_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('problem_references', function (Blueprint $table) {
            $table->longText('reference_title')->change();
            $table->longText('reference_link')->change();
        });
    }
};
