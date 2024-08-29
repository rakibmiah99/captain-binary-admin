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
        Schema::create('problem_details', function (Blueprint $table) {
            $table->id();
            $table->longText('instructions');
            $table->longText('instructions_bn');
            $table->text('code')->nullable();
            $table->string('test_case',1000);
            $table->string('point',10);

            $table->unsignedBigInteger('problem_id')->unique();
            $table->foreign('problem_id')->references('id')->on('problems')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problem_details');
    }
};
