<?php
namespace App\Http\Requests\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class ValidEmergencyLeave implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fromDate = Carbon::parse(request()->input('from_date'));
        
        // Check if submitted 2 days before
        if (now()->diffInDays($fromDate) < 2) {
            $fail('Emergency leave must be submitted at least 2 days before the start date.');
        }
    }
}