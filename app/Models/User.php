<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([ 
        'employee_id',
        'name',
        'email',
        'password',
        'designation',
        'department_id',
        'nationality_id',
        'date_of_joining',
        'mobile_no',
        'home_country_mob_no',])]

#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_joining' => 'date',
        ];
    }

     public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
     public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
      public function leaveBalance()
    {
        return $this->hasOne(LeaveBalance::class)->where('year', date('Y'));
    }

    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }
     public function leaveHistories()
    {
        return $this->hasMany(LeaveHistory::class);
    }
    // accessors for department and nationality names
    public function getDepartmentNameAttribute()
    {
        return $this->department?->name;
    }

    public function getNationalityNameAttribute()
    {
        return $this->nationality?->name;
    }
}
