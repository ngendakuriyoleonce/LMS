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
        Schema::create('leave_balances', function (Blueprint $table) {
             $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->year('year');
            $table->decimal('annual_leave_entitled', 5, 1)->default(30);
            $table->decimal('sick_leave_entitled', 5, 1)->default(15);
            $table->decimal('emergency_leave_entitled', 5, 1)->default(5);
            $table->decimal('annual_leave_used', 5, 1)->default(0);
            $table->decimal('sick_leave_used', 5, 1)->default(0);
            $table->decimal('emergency_leave_used', 5, 1)->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};
