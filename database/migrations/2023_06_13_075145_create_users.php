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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('firstName',50);
            $table->string('lastName',50);
            $table->string('mobile',50);
            $table->string('password',50);
            $table->string('photo',200)->default('/photos/01_photo_default.svg');

            $table->string('facebook',300)->default("");
            $table->string('linkedin',300)->default("");
            $table->string('whatsapp',300)->default("");
            $table->string('github',300)->default("");
            $table->string('youtube',300)->default("");


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
