<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

       // Permissions
Permission::firstOrCreate(['name' => 'create leave request']);
Permission::firstOrCreate(['name' => 'view own leave requests']);
Permission::firstOrCreate(['name' => 'cancel own leave request']);

Permission::firstOrCreate(['name' => 'view department leave requests']);
Permission::firstOrCreate(['name' => 'approve leave as manager']);

Permission::firstOrCreate(['name' => 'view all leave requests']);
Permission::firstOrCreate(['name' => 'approve leave as hr']);
Permission::firstOrCreate(['name' => 'validate leave eligibility']);
Permission::firstOrCreate(['name' => 'update leave balance']);
Permission::firstOrCreate(['name' => 'manage leave types']);

Permission::firstOrCreate(['name' => 'approve leave as ceo']);

Permission::firstOrCreate(['name' => 'reject leave request']);
Permission::firstOrCreate(['name' => 'view leave reports']);
Permission::firstOrCreate(['name' => 'export leave reports']);

Permission::firstOrCreate(['name' => 'view users']);
Permission::firstOrCreate(['name' => 'create users']);
Permission::firstOrCreate(['name' => 'edit users']);
Permission::firstOrCreate(['name' => 'delete users']);
Permission::firstOrCreate(['name' => 'assign roles']);


// Roles
$ceo = Role::firstOrCreate(['name' => 'ceo']);
$hr = Role::firstOrCreate(['name' => 'hr']);
$manager = Role::firstOrCreate(['name' => 'manager']);
$employee = Role::firstOrCreate(['name' => 'employee']);


// CEO - all permissions
$ceo->givePermissionTo(Permission::all());


// HR permissions
$hr->givePermissionTo([
    'view all leave requests',
    'approve leave as hr',
    'validate leave eligibility',
    'update leave balance',
    'manage leave types',
    'reject leave request',
    'view leave reports',
    'export leave reports',
    'view users',
]);


// Manager permissions
$manager->givePermissionTo([
    'view department leave requests',
    'approve leave as manager',
    'reject leave request',
    'view leave reports',
]);


// Employee permissions
$employee->givePermissionTo([
    'create leave request',
    'view own leave requests',
    'cancel own leave request',
]);
    }
}
