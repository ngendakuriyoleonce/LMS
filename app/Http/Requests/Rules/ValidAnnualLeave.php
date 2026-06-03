<?php

namespace App\Http\Requests\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class ValidAnnualLeave implements ValidationRule
{
    protected string $userId;
    
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fromDate = Carbon::parse(request()->input('from_date'));
        $totalDays = request()->input('total_days');
        
        // Check if submitted 2 months in advance
        if (now()->diffInMonths($fromDate) < 2) {
            $fail('Annual leave must be applied at least 2 months in advance.');
        }
        
        // Check leave balance
        $user = \App\Models\User::find($this->userId);
        $balance = $user->leaveBalance;
        
        if ($balance) {
            $available = $balance->annual_leave_entitled - $balance->annual_leave_used;
            if ($totalDays > $available) {
                $fail("Insufficient annual leave balance. Available: {$available} days.");
            }
        }
    }
}