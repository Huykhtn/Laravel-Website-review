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
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_name');
            $table->string('description')->nullable();
            // $table->string('teacher');
            // $table->integer('price');
            $table->tinyInteger('status')->default(1)->comment("1: Active & 2: Block")->nullable();
            $table->unsignedBigInteger('major_id');
            $table->foreign('major_id')->references('major_id')->on('majors');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
