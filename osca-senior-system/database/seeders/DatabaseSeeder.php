<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SeniorCitizen;
use App\Models\Benefit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email'=>'admin@osca.test'],
            ['name'=>'OSCA Administrator','password'=>Hash::make('password'),'role'=>'admin']
        );

        User::updateOrCreate(
            ['email'=>'staff@osca.test'],
            ['name'=>'OSCA Staff','password'=>Hash::make('password'),'role'=>'staff']
        );

        $samples = [
            ['Juan','Dela','Cruz','1948-03-12','Male','Poblacion','Yes','Yes'],
            ['Maria','Santos','Reyes','1950-07-25','Female','Poblacion','Yes','Yes'],
            ['Pedro','','Garcia','1945-11-02','Male','San Nicolas','No','Yes'],
            ['Ana','Lopez','Mendoza','1947-01-18','Female','San Felipe','Yes','No'],
            ['Jose','','Fernandez','1942-09-30','Male','Alacan','Yes','Yes'],
        ];

        foreach ($samples as [$first,$middle,$last,$birth,$sex,$barangay,$pension,$philhealth]) {
            $senior = SeniorCitizen::firstOrCreate(
                ['first_name'=>$first,'last_name'=>$last,'birth_date'=>$birth],
                [
                    'senior_id'=>'SC-2026-'.strtoupper(substr(md5($first.$last.$birth),0,6)),
                    'middle_name'=>$middle,
                    'sex'=>$sex,
                    'address'=>'Sample address',
                    'barangay'=>$barangay,
                    'pension_status'=>$pension,
                    'philhealth_status'=>$philhealth,
                    'qr_code'=>hash('sha256',$first.$last.$birth),
                    'status'=>'active'
                ]
            );

            Benefit::firstOrCreate(
                ['senior_citizen_id'=>$senior->id,'benefit_type'=>'Senior Citizen Benefit'],
                ['amount'=>500,'distribution_date'=>now()->toDateString(),'status'=>'Paid']
            );
        }
    }
}
