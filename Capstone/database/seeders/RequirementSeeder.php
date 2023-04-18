<?php

namespace Database\Seeders;

use App\Models\Academic;
use App\Models\Requirement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requirement::createRequirement('Grade', ['application/pdf', 'image/png', 'image/jpeg'], Carbon::create(2023, 1, 23), Academic::getAcademicID('2022','First'), User::whereHas('scholar')->inRandomOrder());
        Requirement::createRequirement('Return Service', ['application/pdf', 'image/png', 'image/jpeg'], Carbon::create(2023, 1, 23), Academic::getAcademicID('2022','First'),User::whereHas('scholar')->inRandomOrder());
        Requirement::createRequirement('Grade', ['application/pdf', 'image/png', 'image/jpeg'], Carbon::create(2023, 1, 23), Academic::getAcademicID('2022','Second'),User::whereHas('scholar')->inRandomOrder());
    }
}
