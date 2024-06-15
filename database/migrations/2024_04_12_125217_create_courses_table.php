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
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->integer('teacher_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('specialization_id')->constrained('specializations')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('country_id')->constrained('countries')->nullable()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['pending', 'accepted'])->default('pending');
            $table->timestamps();
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
