<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('course_id')->nullable()->constrained();
            $table->string('code')->nullable();
            $table->string('idtype')->nullable();
            $table->string('identification')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('rh')->nullable();
            $table->text('diseases')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_mobile')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_mobile')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
