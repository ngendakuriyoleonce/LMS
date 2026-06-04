<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveBalance;
use App\Models\User;

class LeaveBalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = User::all();
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;

        foreach ($users as $user) {
            // Create balance for current year
            LeaveBalance::firstOrCreate(
                ['user_id' => $user->id, 'year' => $currentYear],
                [
                    'annual_leave_entitled' => 30,
                    'sick_leave_entitled' => 15,
                    'emergency_leave_entitled' => 5,
                    'annual_leave_used' => 0,
                    'sick_leave_used' => 0,
                    'emergency_leave_used' => 0,
                ]
            );

            // Create balance for last year (for testing) 
            if ($user->hasRole('employee')) {
                LeaveBalance::firstOrCreate(
                    ['user_id' => $user->id, 'year' => $lastYear],
                    [
                        'annual_leave_entitled' => 30,
                        'sick_leave_entitled' => 15,
                        'emergency_leave_entitled' => 5,
                        'annual_leave_used' => rand(5, 25),
                        'sick_leave_used' => rand(0, 5),
                        'emergency_leave_used' => rand(0, 3),
                    ]
                );
            } else {
                LeaveBalance::firstOrCreate(
                    ['user_id' => $user->id, 'year' => $lastYear],
                    [
                        'annual_leave_entitled' => 30,
                        'sick_leave_entitled' => 15,
                        'emergency_leave_entitled' => 5,
                        'annual_leave_used' => rand(10, 20),
                        'sick_leave_used' => rand(0, 3),
                        'emergency_leave_used' => rand(0, 2),
                    ]
                );
            }
        }
    }
}
    
