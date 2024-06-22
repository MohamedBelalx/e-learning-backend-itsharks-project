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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedSmallInteger('duration');
            $table->boolean('is_approved')->default(false);
            $table->unsignedSmallInteger('price');
            $table->enum('lang', ['arabic', 'english']);
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
