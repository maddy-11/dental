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
        Schema::create('pending_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('examination_id')->nullable()->constrained('examinations')->onDelete('cascade');
            $table->decimal('pending_salary', 8, 2)->nullable();
            $table->decimal('paid_salary', 8, 2)->nullable();
            $table->decimal('overpaid_salary', 8, 2)->nullable();
            $table->string('salaryType')->nullable();
            $table->integer('salaryPercentage')->nullable();
            $table->string('month')->nullable();
            $table->boolean('paid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_payments');
    }
};
