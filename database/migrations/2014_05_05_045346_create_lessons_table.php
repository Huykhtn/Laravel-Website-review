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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id('lesson_id');
            $table->string('lesson_name');
            $table->integer('weekday');
            $table->string('start_time');
            $table->string('end_time');
            $table->tinyInteger('status')->default(1)->comment("1: Active & 2: Block");
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
