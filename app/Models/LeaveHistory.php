<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_request_id',
        'action',
        'from_status',
        'to_status',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveRequest()
    {
        return $this->belongsTo(LeaveRequest::class);
    }
}