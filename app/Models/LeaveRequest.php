<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
     use HasFactory,SoftDeletes;

    protected $table = 'leave_requests';

    protected $fillable = [
        'ref_no',
        'user_id',
        'leave_type',
        'from_date',
        'to_date',
        'total_days',
        'reason',
        'status',
        'substitute_employee',
        'substitute_date',
        'medical_certificate',
        'handover_paper',
        'leave_eligibility',
        'total_leave_balance',
        'previous_leave_availed',
        'remaining_leave_balance',
        'hr_validation_date',
        'employee_signed_at',
        'manager_signed_at',
        'hr_signed_at',
        'ceo_signed_at',
        'manager_comment',
        'hr_comment',
        'ceo_comment',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'substitute_date' => 'datetime',
        'hr_validation_date' => 'date',
        'employee_signed_at' => 'datetime',
        'manager_signed_at' => 'datetime',
        'hr_signed_at' => 'datetime',
        'ceo_signed_at' => 'datetime',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function substituteEmployee()
    {
        return $this->belongsTo(User::class, 'substitute_employee');
    }

    public function histories()
    {
        return $this->hasMany(LeaveHistory::class);
    }

   
    public static function generateRefNo()
    {
        $year = date('Y');
        $month = date('m');
        $lastRequest = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastRequest) {
            $lastNumber = intval(substr($lastRequest->ref_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return "LVE/{$year}{$month}/{$newNumber}";
    }
      public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending_manager' => 'bg-yellow-500',
            'pending_hr' => 'bg-blue-500',
            'pending_ceo' => 'bg-purple-500',
            'approved' => 'bg-green-500',
            'rejected' => 'bg-red-500',
            'cancelled' => 'bg-gray-500',
            default => 'bg-gray-500',
        };
    }
    
    public function getStatusText()
    {
        return match($this->status) {
            'pending_manager' => 'Pending Manager Approval',
            'pending_hr' => 'Pending HR Approval',
            'pending_ceo' => 'Pending CEO Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
}
}