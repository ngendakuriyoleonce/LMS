<?php

namespace Database\Seeders;
use App\Models\Nationality;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //  departments
        $execDept =Department::where('code', 'EXEC')->first();
        $hrDept = Department::where('code', 'HR')->first();
        $itDept = Department::where('code', 'IT')->first();
        $financeDept = Department::where('code', 'FIN')->first();
        $salesDept = Department::where('code', 'SALES')->first();

        //  nationalities
$burundiNat = Nationality::where('code', 'BI')->first();
$kenyaNat = Nationality::where('code', 'KE')->first();
$rwandaNat = Nationality::where('code', 'RW')->first();
$southSudanNat = Nationality::where('code', 'SS')->first();
$tanzaniaNat = Nationality::where('code', 'TZ')->first();
$ugandaNat = Nationality::where('code', 'UG')->first();

        // CEO 
        $ceo = User::firstOrCreate(
            ['email' => 'ceo@gmail.com'],
            [
                'employee_id' => 'CEO001',
                'name' => 'Ngendakuriyo leonce',
                'password' => Hash::make('password'),
                'designation' => 'Chief Executive Officer',
                'department_id' => $execDept->id,
                'nationality_id' => $burundiNat->id,
                'date_of_joining' => '2022-01-01',
                'mobile_no' => '+25712345678',
                'home_country_mob_no' => '+25712345678',
            ]
        );
        $ceo->assignRole('ceo');

        // HR Managers 
        $hrManager = User::firstOrCreate(
            ['email' => 'hr@.com'],
            [
                'employee_id' => 'HR001',
                'name' => 'MUGISHA patrick',
                'password' => Hash::make('password'),
                'designation' => 'HR Manager',
                'department_id' => $hrDept->id,
                'nationality_id' => $kenyaNat->id,
                'date_of_joining' => '2018-03-15',
                'mobile_no' => '+254123456789',
                'home_country_mob_no' => '+201234567890',
            ]
        );
        $hrManager->assignRole('hr');

        // HR Assistant
        $hrAssistant = User::firstOrCreate(
            ['email' => 'hr.assistant@gmail.com'],
            [
                'employee_id' => 'HR002',
                'name' => 'IRADUKUNDA JHON',
                'password' => Hash::make('password'),
                'designation' => 'HR Assistant',
                'department_id' => $hrDept->id,
                'nationality_id' => $rwandaNat->id,
                'date_of_joining' => '2022-03-20',
                'mobile_no' => '+250123456789',
                'home_country_mob_no' => '+201234567891',
            ]
        );
        $hrAssistant->assignRole('hr');

        // ========== Managers ==========
        // IT Manager
        $itManager = User::firstOrCreate(
            ['email' => 'manager.it@gmail.com'],
            [
                'employee_id' => 'MGR001',
                'name' => 'NDBIRENDERE Patrick',
                'password' => Hash::make('password'),
                'designation' => 'IT Manager',
                'department_id' => $itDept->id,
                'nationality_id' => $southSudanNat->id,
                'date_of_joining' => '2019-06-20',
                'mobile_no' => '+971504444444',
                'home_country_mob_no' => '+962712345678',
            ]
        );
        $itManager->assignRole('manager');

        // Finance Manager
        $financeManager = User::firstOrCreate(
            ['email' => 'manager.finance@gmail.com'],
            [
                'employee_id' => 'MGR002',
                'name' => 'AKIMANA Jean',
                'password' => Hash::make('password'),
                'designation' => 'Finance Manager',
                'department_id' => $financeDept->id,
                'nationality_id' => $kenyaNat->id,
                'date_of_joining' => '2017-11-10',
                'mobile_no' => '+971505555555',
                'home_country_mob_no' => '+971505555555',
            ]
        );
        $financeManager->assignRole('manager');

        // Sales Manager
        $salesManager = User::firstOrCreate(
            ['email' => 'manager.sales@gmail.com'],
            [
                'employee_id' => 'MGR003',
                'name' => 'DUSENGE Eric',
                'password' => Hash::make('password'),
                'designation' => 'Sales Manager',
                'department_id' => $salesDept->id,
                'nationality_id' => $tanzaniaNat->id,
                'date_of_joining' => '2018-09-05',
                'mobile_no' => '+971506666666',
                'home_country_mob_no' => '+971506666666',
            ]
        );
        $salesManager->assignRole('manager');

        // ========== Employees ==========
        // IT Department Employees
        $employee1 = User::firstOrCreate(
            ['email' => 'employee.omar@gmail.com'],
            [
                'employee_id' => 'EMP001',
                'name' => 'Omar Hassan',
                'password' => Hash::make('password'),
                'designation' => 'Senior Software Developer',
                'department_id' => $itDept->id,
                'nationality_id' => $ugandaNat->id,
                'date_of_joining' => '2021-01-10',
                'mobile_no' => '+971507777777',
                'home_country_mob_no' => '+249123456789',
            ]
        );
        $employee1->assignRole('employee');

        $employee2 = User::firstOrCreate(
            ['email' => 'employee.ahmed@gmail.com'],
            [
                'employee_id' => 'EMP002',
                'name' => 'KWIZERA Eric',
                'password' => Hash::make('password'),
                'designation' => 'Software Developer',
                'department_id' => $itDept->id,
                'nationality_id' => $tanzaniaNat->id,
                'date_of_joining' => '2022-08-15',
                'mobile_no' => '+971508888888',
                'home_country_mob_no' => '+201234567892',
            ]
        );
        $employee2->assignRole('employee');

        $employee3 = User::firstOrCreate(
            ['email' => 'employee.maria@gmail.com'],
            [
                'employee_id' => 'EMP003',
                'name' => 'HARERIMANA JEANNNE',
                'password' => Hash::make('password'),
                'designation' => 'UI/UX Designer',
                'department_id' => $itDept->id,
                'nationality_id' => $burundiNat->id,
                'date_of_joining' => '2022-11-20',
                'mobile_no' => '+971509999999',
                'home_country_mob_no' => '+639123456789',
            ]
        );
        $employee3->assignRole('employee');

        $employee4 = User::firstOrCreate(
            ['email' => 'employee.raj@gmail.com'],
            [
                'employee_id' => 'EMP004',
                'name' => 'NDAYIRATA NADINE',
                'password' => Hash::make('password'),
                'designation' => 'System Administrator',
                'department_id' => $itDept->id,
                'nationality_id' => $rwandaNat->id,
                'date_of_joining' => '2023-01-15',
                'mobile_no' => '+971501010101',
                'home_country_mob_no' => '+919876543210',
            ]
        );
        $employee4->assignRole('employee');

        // Finance Department Employees
        $employee5 = User::firstOrCreate(
            ['email' => 'employee.nadia@gmail.com'],
            [
                'employee_id' => 'EMP005',
                'name' => 'Nadia Abbas',
                'password' => Hash::make('password'),
                'designation' => 'Accountant',
                'department_id' => $financeDept->id,
                'nationality_id' => $southSudanNat->id,
                'date_of_joining' => '2022-05-10',
                'mobile_no' => '+971502020202',
                'home_country_mob_no' => '+249123456788',
            ]
        );
        $employee5->assignRole('employee');

        $employee6 = User::firstOrCreate(
            ['email' => 'employee.hassan@gmail.com'],
            [
                'employee_id' => 'EMP006',
                'name' => 'Hassan Ibrahim',
                'password' => Hash::make('password'),
                'designation' => 'Junior Accountant',
                'department_id' => $financeDept->id,
                'nationality_id' => $rwandaNat->id,
                'date_of_joining' => '2023-03-01',
                'mobile_no' => '+971503030303',
                'home_country_mob_no' => '+201234567893',
            ]
        );
        $employee6->assignRole('employee');

        // Sales Department Employees
        $employee7 = User::firstOrCreate(
            ['email' => 'employee.layla@gmail.com'],
            [
                'employee_id' => 'EMP007',
                'name' => 'kabura Eric',
                'password' => Hash::make('password'),
                'designation' => 'Sales Executive',
                'department_id' => $salesDept->id,
                'nationality_id' => $kenyaNat->id,
                'date_of_joining' => '2022-07-20',
                'mobile_no' => '+971504040404',
                'home_country_mob_no' => '+971504040404',
            ]
        );
        $employee7->assignRole('employee');

        // HR Department Employee
        $employee8 = User::firstOrCreate(
            ['email' => 'employee.reem@gmail.com'],
            [
                'employee_id' => 'EMP008',
                'name' => 'REEM ALI',
                'password' => Hash::make('password'),
                'designation' => 'Recruitment Specialist',
                'department_id' => $hrDept->id,
                'nationality_id' => $ugandaNat->id,
                'date_of_joining' => '2022-09-12',
                'mobile_no' => '+971505050505',
                'home_country_mob_no' => '+962712345679',
            ]
        );
        $employee8->assignRole('employee');
    }
}
