<?php

namespace Database\Seeders;

use App\Models\Requirement;
use App\Models\Scholar;
use App\Models\ScholarshipProgram;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([


            SponsorSeeder::class,
            ScholarshipProgramSeeder::class,

            BaranggaySeeder::class,
            CollegeSeeder::class,
            ProgramSeeder::class,


            ScholarshipOrganizationSeeder::class,
            ScholarshipOrganizationScholarshipProgramSeeder::class,

            SemesterSeeder::class,
            AcademicSeeder::class,
            // ShieldSeeder::class,

            // ScholarSeeder::class,

            RequirementSeeder::class,
            UserSeeder::class,


        ]);
    }
}
