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
        Schema::create('total_pending_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('pending_salary', 8, 2)->nullable();
            $table->decimal('paid_salary', 8, 2)->nullable();
            $table->string('salaryType')->nullable();
            $table->string('month')->nullable();
            $table->boolean('paid_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_pending_salaries');
    }
};
