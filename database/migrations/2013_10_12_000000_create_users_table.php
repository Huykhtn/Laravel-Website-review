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
            $table->id('user_id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullname')->nullable();
            $table->tinyInteger('gender')->default(1)->comment("1: Male & 2: Female")->nullable();
            $table->string('phone')->unique();
            $table->tinyInteger('status')->default(1)->comment("1: Active & 2: Block")->nullable();
            // $table->index(['email', 'fullname']);

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->index(['email', 'fullname', 'phone', 'role_id']);
            // $table->unsignedBigInteger('major_id')->nullable();
            // $table->foreign('major_id')->references('major_id')->on('majors');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->rememberToken();
            $table->timestamps();
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
