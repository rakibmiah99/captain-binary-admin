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
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('designation')->change();
            $table->json('comments')->change();
            $table->string('img', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('designation')->change();
            $table->text('comments')->change();
            $table->string('img', 1000)->change();
        });
    }
};
