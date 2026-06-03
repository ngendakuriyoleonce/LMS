<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Static data
        $this->call([
            DepartmentSeeder::class,
            NationalitySeeder::class,
        ]);

        // 2. Roles & Permissions
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // 3. Users
        $this->call([
            UsersSeeder::class,
        ]);

        // 4. Leave balances
        $this->call([
            LeaveBalancesSeeder::class,
        ]);
    }
}
