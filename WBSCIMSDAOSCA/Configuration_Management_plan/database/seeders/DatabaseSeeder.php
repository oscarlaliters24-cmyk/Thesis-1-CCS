<?php

namespace Database\Seeders;

use App\Models\Benefit;
use App\Models\SeniorCitizen;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'OSCA Administrator',
            'email' => 'admin@osca.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'OSCA Staff',
            'email' => 'staff@osca.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $people = [
            ['100001','Juan','Dela Cruz','Male','Married','San Nicolas'],
            ['100002','Maria','Santos','Female','Widowed','Poblacion'],
            ['100003','Pedro','Reyes','Male','Single','Tempra-San Roque'],
        ];

        foreach ($people as [$id,$first,$last,$sex,$civil,$barangay]) {
            $person = SeniorCitizen::create([
                'osca_id' => $id,
                'first_name' => $first,
                'last_name' => $last,
                'birth_date' => now()->subYears(68)->subDays(rand(1,300))->format('Y-m-d'),
                'sex' => $sex,
                'civil_status' => $civil,
                'barangay' => $barangay,
                'address' => $barangay . ', San Fabian, Pangasinan',
                'contact_number' => '09' . rand(100000000,999999999),
                'pension_type' => 'Social Pension',
                'pension_enrolled' => true,
                'qr_token' => (string) Str::uuid(),
                'is_active' => true,
            ]);

            Benefit::create([
                'senior_citizen_id' => $person->id,
                'benefit_type' => 'Senior Citizen Benefit',
                'amount' => 1000,
                'status' => 'pending',
            ]);
        }
    }
}