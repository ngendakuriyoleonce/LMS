<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run(): void
    {
        $departments = [
            [
                'name' => 'Executive',
                'code' => 'EXEC',
                'description' => 'Executive Management Department',
                'is_active' => true,
            ],
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Human Resources Department',
                'is_active' => true,
            ],
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'Information Technology Department',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Finance and Accounting Department',
                'is_active' => true,
            ],
            [
                'name' => 'Operations',
                'code' => 'OPS',
                'description' => 'Operations Department',
                'is_active' => true,
            ],
            [
                'name' => 'Sales',
                'code' => 'SALES',
                'description' => 'Sales Department',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Marketing Department',
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'code' => 'LEGAL',
                'description' => 'Legal Affairs Department',
                'is_active' => true,
            ],
            [
                'name' => 'Procurement',
                'code' => 'PROC',
                'description' => 'Procurement Department',
                'is_active' => true,
            ],
        ];
        foreach ($departments as $department) {
            \App\Models\Department::firstOrCreate(
                ['code' => $department['code']],
                $department
            );
}
} 
}