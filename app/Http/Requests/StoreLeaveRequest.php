<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Rules\ValidAnnualLeave;
use App\Http\Requests\Rules\ValidEmergencyLeave;

class StoreLeaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'leave_type' => ['required', Rule::in(['annual', 'emergency', 'sick', 'maternity', 'unpaid', 'other'])],
              'from_date' => [
        'required',
        'date',
        'after_or_equal:today',
    ],
            'to_date' => 'required|date|after_or_equal:from_date',
            'total_days' => 'required|integer|min:1|max:365',
            'reason' => 'nullable|string|max:1000',
            'medical_certificate' => 'required_if:leave_type,sick|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
            'handover_paper' => 'required_if:leave_type,annual|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
            'substitute_employee' => 'nullable|exists:users,id',
            'substitute_date' => 'nullable|date|after_or_equal:from_date',
        ];
        // Add custom rules based on leave type
        if ($this->input('leave_type') === 'annual') {
            $rules['from_date'][] = new ValidAnnualLeave($this->user()->id);
        }
        
        if ($this->input('leave_type') === 'emergency') {
            $rules['from_date'][] = new ValidEmergencyLeave();
        }
        
        return $rules;
    
        }

     public function messages(): array
    {
        return [
            // Leave type
            'leave_type.required' => 'Please select a leave type',
            'leave_type.in' => 'Invalid leave type selected',
            
            // Dates
            'from_date.required' => 'Please select start date',
            'from_date.date' => 'Invalid start date format',
            'from_date.after_or_equal' => 'Start date cannot be in the past',
            
            'to_date.required' => 'Please select end date',
            'to_date.date' => 'Invalid end date format',
            'to_date.after_or_equal' => 'End date must be after or equal to start date',
            
            // Days
            'total_days.required' => 'Please enter total days',
            'total_days.integer' => 'Total days must be a number',
            'total_days.min' => 'Total days must be at least 1 day',
            'total_days.max' => 'Total days cannot exceed 365 days',
            
            // Reason
            'reason.max' => 'Reason cannot exceed 1000 characters',
            
            // Files
            'medical_certificate.required_if' => 'Medical certificate is required for sick leave',
            'medical_certificate.file' => 'Medical certificate must be a valid file',
            'medical_certificate.mimes' => 'Medical certificate must be PDF, JPG, JPEG,word or PNG',
            'medical_certificate.max' => 'Medical certificate cannot exceed 2MB',
            
            'handover_paper.required_if' => 'Handover paper is required for annual leave',
            'handover_paper.file' => 'Handover paper must be a valid file',
            'handover_paper.mimes' => 'Handover paper must be pdf, JPG, JPEG,word or PNG',
            'handover_paper.max' => 'Handover paper cannot exceed 2MB',
            
            // Substitute
            'substitute_employee.exists' => 'Selected substitute employee does not exist',
            'substitute_date.after_or_equal' => 'Substitute date must be after or equal to start date',
        ];
    }

    public function attributes(): array
    {
        return [
            'leave_type' => 'leave type',
            'from_date' => 'start date',
            'to_date' => 'end date',
            'total_days' => 'total days',
            'reason' => 'reason',
            'medical_certificate' => 'medical certificate',
            'handover_paper' => 'handover paper',
            'substitute_employee' => 'substitute employee',
            'substitute_date' => 'substitute date',
        ];
    }
}
