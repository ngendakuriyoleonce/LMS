<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $nationalities = [
    ['name' => 'Burundi', 'code' => 'BI', 'is_active' => true],
    ['name' => 'Kenya', 'code' => 'KE', 'is_active' => true],
    ['name' => 'Rwanda', 'code' => 'RW', 'is_active' => true],
    ['name' => 'South Sudan', 'code' => 'SS', 'is_active' => true],
    ['name' => 'Tanzania', 'code' => 'TZ', 'is_active' => true],
    ['name' => 'Uganda', 'code' => 'UG', 'is_active' => true],
    ['name' => 'Democratic Republic of the Congo', 'code' => 'CD', 'is_active' => true],
    ['name' => 'Somalia', 'code' => 'SO', 'is_active' => true],

    ['name' => 'Ethiopia', 'code' => 'ET', 'is_active' => true],
    ['name' => 'Eritrea', 'code' => 'ER', 'is_active' => true],
    ['name' => 'Djibouti', 'code' => 'DJ', 'is_active' => true],
    ['name' => 'Sudan', 'code' => 'SD', 'is_active' => true],
    ['name' => 'Egypt', 'code' => 'EG', 'is_active' => true],
    ['name' => 'Libya', 'code' => 'LY', 'is_active' => true],
    ['name' => 'Tunisia', 'code' => 'TN', 'is_active' => true],
    ['name' => 'Algeria', 'code' => 'DZ', 'is_active' => true],
    ['name' => 'Morocco', 'code' => 'MA', 'is_active' => true],

    ['name' => 'Nigeria', 'code' => 'NG', 'is_active' => true],
    ['name' => 'Ghana', 'code' => 'GH', 'is_active' => true],
    ['name' => 'Cameroon', 'code' => 'CM', 'is_active' => true],

    ['name' => 'South Africa', 'code' => 'ZA', 'is_active' => true],
    ['name' => 'Zimbabwe', 'code' => 'ZW', 'is_active' => true],
    ['name' => 'Zambia', 'code' => 'ZM', 'is_active' => true],
    ['name' => 'Mozambique', 'code' => 'MZ', 'is_active' => true],
];
        foreach ($nationalities as $nationality) {
            \App\Models\Nationality::firstOrCreate(
                ['code' => $nationality['code']],
                $nationality
            );
        }
    }
}
