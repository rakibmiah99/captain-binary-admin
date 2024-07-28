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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('categoryName', 1000)->nullable()->change();
            $table->string('categoryName_bn', 1000)->nullable()->change();
            $table->string('categoryDetails', 1000)->nullable()->change();
            $table->string('categoryDetails_bn', 1000)->nullable()->change();
            $table->string('categoryImg', 300)->nullable()->change();
            $table->string('itemTotal', 50)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('categoryName', 1000)->change();
            $table->string('categoryName_bn', 1000)->change();
            $table->string('categoryDetails', 1000)->change();
            $table->string('categoryDetails_bn', 1000)->change();
            $table->string('categoryImg', 300)->change();
            $table->string('itemTotal', 50)->change();
        });
    }
};
