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
        Schema::create('leave_requests', function (Blueprint $table) {
             $table->id();
            $table->string('ref_no')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('leave_type', ['annual', 'emergency', 'sick', 'maternity', 'unpaid', 'other']);
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('total_days');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending_manager','cancelled','pending_hr', 'pending_ceo', 'approved', 'rejected'])->default('pending_manager');
            $table->foreignId('substitute_employee')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('substitute_date')->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('handover_paper')->nullable();
            $table->string('leave_eligibility')->nullable();
            $table->decimal('total_leave_balance', 5, 1)->default(0);
            $table->decimal('previous_leave_availed', 5, 1)->default(0);
            $table->decimal('remaining_leave_balance', 5, 1)->default(0);
            $table->date('hr_validation_date')->nullable();
            $table->timestamp('employee_signed_at')->nullable();
            $table->timestamp('manager_signed_at')->nullable();
            $table->timestamp('hr_signed_at')->nullable();
            $table->timestamp('ceo_signed_at')->nullable();
            $table->text('manager_comment')->nullable();
            $table->text('hr_comment')->nullable();
            $table->text('ceo_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('ref_no');
            $table->index('status');
            $table->index('leave_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
